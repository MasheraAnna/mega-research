<?php
class Question {
 
    public  $question = array();
    public  $variantes = array();
    public  $scale = array();
    private $connection;
    private $respId;
    public  $qData = array();
    private $lastQuestionAsked;
    public  $name = array();
    
    // todo:
    // 2) почему-то он позволяет до 7го вопроса пройти не заполняя ничего, а дальше идет только, если
    // я что-нибудь заполню - разобраться почему - это как-то связано с новыми условиями в конструкторе
    
    public function __construct($dbhost, $dbuser, $dbpassword, $dbname){
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (mysqli_connect_errno()) {
            die ("Database connection failed: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
        }
        mysqli_set_charset($this->connection,"utf8");        
        $this->respId = $this->getUserID();
        
        // проверяем на наличие двух ключевых параметров: qid и respId
        // в зависимости от них определяем, какой вопрос задать респонденту
        
        $testQId = filter_input (INPUT_GET, 'qId', FILTER_SANITIZE_NUMBER_INT);
        
        if ($testQId && $this->respId){
            $this->getLastQuestionAsked();
            
            if ($testQId == ($this->lastQuestionAsked+1) or $testQId < ($this->lastQuestionAsked+1)){
                // считай, что следующим задаем вопрос, который получили из GET
                // сходи в базу, проверь, можем ли мы показать этот вопрос.
                $testQId = $this->ifAskThisQ($testQId);
                $qId = $testQId;
                $this->question["id"]= $testQId;
            } else {
                // считаем, что следующим задаем вопрос, который идет следующим в базе по порядку
                $qId = $this->lastQuestionAsked+1;
                // сходи в базу, проверь, можем ли мы задать этот вопрос в соответствии с условиями
                $nextQId = $this->ifAskThisQ($qId);
                $qId = $nextQId;
                $this->question["id"]= $nextQId;
            }
        } else if ($this->respId) {
            $this->getLastQuestionAsked();
            // проверь, можем ли мы задать этот вопрос!
            $testQId = $this->lastQuestionAsked+1;
            $qId = $this->ifAskThisQ($testQId);
            $this->question["id"]=$qId;
        } else {
            $qId = 1;
            $this->question["id"]=1; 
        }
        
        // заполним свойства объекта:
        $this->fetchStep($qId);
        $this->fetchVariantes();
        
        // получим из базы ответы на этот вопрос, если он уже задавался
        $this->getThisQData();
        
        $this->fetchName();
    }
    
    
    // методы:
    
    // эта функция делает доступной переменные в массивах-свойствах класса.
    // обязательно почитать про эту штуку!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function __get( $name ){
        if (array_key_exists($name, $this->question)){
            return $this->question[$name];
        }
    }
    
    private function getUserID(){
        if (isset($_COOKIE["respId"])){
            $respId = mysqli_real_escape_string($this->connection, $_COOKIE["respId"]);
            $query = "SELECT * FROM `respondents` WHERE `respId`='$respId'";
            $result = mysqli_query($this->connection, $query);
            if(mysqli_num_rows($result)) {
                return $respId;
            }
        }
        return false;
    }
    
    // эта функция получает id следующего вопроса
    public function ifAskThisQ($nextQuestion){

        // пойди в таблицу с данными и выбери все данные по условиям из таблицы qconditions
        // если результат запроса вернулся не пустым, то условие выполняется
        // если результат вернулся пустым - сходи в базу с таким же запросом по следующиму условию
        
        $showQuestion = false;
        while ($showQuestion == false){
            
            $nextQ = mysqli_real_escape_string($this->connection, $nextQuestion);
            $respId = mysqli_real_escape_string($this->connection, $this->respId);
            
            $queryConditionExists = "SELECT * FROM `qconditions` WHERE `qId` = $nextQ";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
            
            if (mysqli_num_rows($resultConditionExists)){
                $queryToCheck = "SELECT qconditions.qId, qconditions.conditionType, qconditions.relatedAId, "
                        . "qconditions.equals, data.qId as data_qId ,data.aId as data_aId, data.answer as data_answer "
                        . "FROM `qconditions` INNER JOIN `data` ON  qconditions.relatedAId  = data.aId "
                        . "AND qconditions.equals  = data.answer WHERE qconditions.qId = '$nextQ' AND data.respId = '$respId' ";
                $checkResult = mysqli_query($this->connection, $queryToCheck);
                
                if (mysqli_num_rows($checkResult)){
                    
                    $showQuestion = true;
                } else {
                    $showQuestion = false;
                    $nextQuestion = $nextQuestion + 1;
                }
            } else {
                $showQuestion = true;
            }
        }  
        
        return $nextQuestion;
    }
    
    // эта функци получает id предыдущего вопроса
    public function getPrevQId ($lastAskedQuestion) {
    $prevQuestion = mysqli_real_escape_string($this->connection, $lastAskedQuestion) - 1;
        
        // Проверим, есть ли у него условие и выполняется ли оно:
        // ходим по циклу, пока не найдем выполняющееся условие
        $showQuestion = false;
        while ($showQuestion == false){
            
            $nextQ = mysqli_real_escape_string($this->connection, $prevQuestion);
            $respId = mysqli_real_escape_string($this->connection, $this->respId);
            
            $queryConditionExists = "SELECT * FROM `qconditions` WHERE `qId` = $nextQ";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
                
            if (mysqli_num_rows($resultConditionExists)){
                
                $queryToCheck = "SELECT qconditions.qId, qconditions.conditionType, qconditions.relatedAId, "
                        . "qconditions.equals, data.qId as data_qId ,data.aId as data_aId, data.answer as data_answer "
                        . "FROM `qconditions` INNER JOIN `data` ON  qconditions.relatedAId  = data.aId "
                        . "AND qconditions.equals  = data.answer WHERE qconditions.qId = '$nextQ' AND data.respId = '$respId'";
                $checkResult = mysqli_query($this->connection, $queryToCheck);

                if (mysqli_num_rows($checkResult)){
                    $showQuestion = true;
                } else {
                    $showQuestion = false;
                    $prevQuestion = $prevQuestion - 1;
                }
            } else {
                $showQuestion = true;
            }
        }  
        
    return $prevQuestion;        
    }

    // эта функция достает из базы текст текущего вопроса
    private function fetchStep ($qId){
        // проверяем на безопасность содержание куки
        $qId = mysqli_real_escape_string($this->connection, $qId);
        $query = "SELECT * FROM `questions` WHERE `id`='$qId'";
        $qeryResult = mysqli_query($this->connection, $query);
        $currentQ = mysqli_fetch_assoc($qeryResult);
        if (isset($currentQ)){
            $this->question = $currentQ;
            return true;
        } else {
            return "can't fetch a question";
        }    
    }
    
    // эта функция получает из базы варианты ответа для текущего вопроса
    private function fetchVariantes (){
         
        $qId = mysqli_real_escape_string($this->connection,$this->id);
        $queryForVariantes = "SELECT answers.id, answers.qId, answers.answer FROM `answers` "
                . "LEFT OUTER JOIN `aconditions`ON answers.id = aconditions.aId "
                . "WHERE answers.qId = '$qId' AND aconditions.id IS NULL ORDER BY answers.answerIndex";
        $resultVariantes = mysqli_query($this->connection, $queryForVariantes);
        
        if (mysqli_num_rows($resultVariantes)){
            
            // это и есть твои варианты
            while ($row = mysqli_fetch_assoc($resultVariantes)){
                $currentVariantes[$row['id']] = $row['answer'];
            }
        } else {
            // пойди в базу и вытащи те, у которых условие есть, и оно выполняется
            $respId = mysqli_real_escape_string($this->connection, $this->respId);
            $qId = mysqli_real_escape_string($this->connection,$this->id);
            
            $queryForVConditions = "SELECT aconditions.aId, answers.answer, answers.answerIndex FROM `aconditions` 
                    INNER JOIN `answers` ON aconditions.aId = answers.id 
                    INNER JOIN `data` ON aconditions.relatedAId = data.aId AND aconditions.equals = data.answer 
                    WHERE aconditions.qId = '$qId' and data.respId = '$respId'";
            
            $resultVConditions = mysqli_query($this->connection, $queryForVConditions);
            
            if (mysqli_num_rows($resultVConditions)){
                while ($rowVConditions = mysqli_fetch_assoc($resultVConditions)){
                    $currentVariantes[$rowVConditions['aId']]=$rowVConditions['answer'];
                }
            } 
        }
        
        if (isset($currentVariantes)){
            $this->variantes = $currentVariantes;
            $this->fetchScale();
            return true;
        } else {
            return "can't fetch variantes";
        }
    }

    // эта функция получает из базы шкалы для ответов для текущего вопроса
    // здесь тоже нужно заменить на ид!!!!!!!!!!!!!!!!!!!!!!!!
    private function fetchScale (){
        $qId = mysqli_real_escape_string($this->connection, $this->id);
        $query = "SELECT * FROM `scales` WHERE `qId`='$qId'";
        $queryResult = mysqli_query($this->connection, $query);
        while ($row = mysqli_fetch_assoc($queryResult)){
            $currentScale[$row['scaleIndex']] = $row['scaleText'];
        }
        if (isset($currentScale)){
            $this->scale = $currentScale;
            return true;
        } else {
            return "can't fetch scale";
        }
    }
    
    // эта функция получает данные по текущему вопросу из базы, если они уже есть
    public function getThisQData (){
        $respId = mysqli_real_escape_string ($this->connection, $this->respId);
        $qId = mysqli_real_escape_string ($this->connection, $this->id);
        $getDataQuery = "SELECT * FROM `data` WHERE `respId` = '$respId' AND `qId` = '$qId' ";
        $getDataResult = mysqli_query ($this->connection, $getDataQuery);
        while($dataRow = mysqli_fetch_assoc($getDataResult)){
            $thisQData[$dataRow['aId']] = $dataRow['answer'];
        }
        if (isset($thisQData)){
        $this->qData = $thisQData;
        }
    }
    
    // эта функция выводит фио респондента
    public function fetchName(){
        $respId = mysqli_real_escape_string($this->connection, $this->respId);
        $queryForName = "SELECT * FROM `data` WHERE `respId`='$respId' AND `qId`='1'";
        $nameRusult = mysqli_query ($this->connection, $queryForName);
        
        while ($row = mysqli_fetch_assoc($nameRusult)){
            $name[$row['aId']] = $row['answer'];
        }
        if(isset($name)){
            $this->name = $name;
        } 
    }
    
    
    // эта функция ставит респонденту id и cookie, если их не было до этого
    private function setRespIdAndCookie(){
        
        if (!$this->respId){
            $startDate = date(DATE_RFC2822);
            $startDate = mysqli_real_escape_string($this->connection, $startDate);
            $query = "INSERT INTO `respondents` (`respId`,`startTime`) VALUES (UUID(),'$startDate')";
            $queryResult = mysqli_query($this->connection, $query);
            $stringId = mysqli_insert_id($this->connection);
            
            $respIdQuery = "SELECT `respId` FROM `respondents` WHERE `id` = '$stringId'";
            $respIdQueryResult = mysqli_query($this->connection, $respIdQuery);
            
            $respIdArray = mysqli_fetch_assoc($respIdQueryResult);
            $respId = $respIdArray['respId'];
            if ($respId){
                $this->respId = $respId;
                $cookie = setcookie("respId", $respId, time() + 3600);
            }
        }
    }
    


    // Эта функция отправляет данные в базу и в сессию
    function sendToDB(){
                
        // проверяем, есть ли у респондента id, т.е. поставлены ли ему cookies, если нет - ставим
        $this->setRespIdAndCookie();
        
        // проверяем, был ли текущий вопрос условием для других вопросов и изменились ли по нему данные.
        // если да, то удаляем все данные из следующих вопросов
        $this->ifThisQuestionDataChanged();
        
        
        $qId = mysqli_real_escape_string ($this->connection, $this->id);
        $respId = mysqli_real_escape_string($this->connection, $this->respId);        
        // Проверяем, есть ли текущий вопрос уже в базе, если да - удаляем его
        $query = "SELECT `id` FROM `data` WHERE `qId` = '$qId' AND respId = '$respId' ";
        $result = mysqli_query ($this->connection, $query);
        if ($this->qData){
            while ($row = mysqli_fetch_assoc($result)){
                // удаление из базы
                $stringId = mysqli_real_escape_string($this->connection, $row["id"]);
                $queryToDelete = "DELETE FROM `data` WHERE `data`.`id` = $stringId";
                $deleteResult = mysqli_query($this->connection, $queryToDelete);
            }
        }

        // вообще для идентификации мне достаточно aId, может быть qId нужно тоже убрать?
        // это лишняя сущность - проверить!!!!!!!!!!!!!!!!!!!!
        // кстати, нужно все массивы post тоже обработать, чтобы не обращаться к ним непосредственно.
        // вопрос - как тут экранировать символы? у меня же массив? filter_input не применяется к массиву
        
        if (isset ($_POST['name'])){
            foreach ($_POST['name'] as $key => $value){
                $query = "INSERT INTO `data` (`respId`,`qId`,`aId`,`answer`)"
                        . "VALUES ('$respId','$qId','$value','true')";
                $result = mysqli_query($this->connection, $query);
            }
        } else {
            foreach ($_POST as $key => $value) {
                    $query = "INSERT INTO `data` (`respId`,`qId`,`aId`,`answer`)"
                            . "VALUES ('$respId','$qId','$key','$value')";                
                $result = mysqli_query($this->connection, $query);
            }
        }
    }
    
    
    private function getLastQuestionAsked(){
        // обратимся в базу, вытащим все записи текущего респондента.
        $respId = mysqli_real_escape_string($this->connection, $this->respId);
        $query = "SELECT `qId` FROM `data` WHERE `respId` ='$respId'";
        $result = mysqli_query ($this->connection, $query);
        if (mysqli_num_rows($result)){
        // сложим все полученные записи в массив $askedQestionsArray
            while ($row = mysqli_fetch_assoc($result)){
                $askedQestionsArray[]=$row['qId'];
            }
            // определим, какой вопрос был задан последним, для этого сортируем массив по убыванию
            sort($askedQestionsArray);
            $maxKey = max(array_keys($askedQestionsArray));
            $lastAskedQuestion = $askedQestionsArray[$maxKey];
            if ($lastAskedQuestion){
                $this->lastQuestionAsked = $lastAskedQuestion;
            }
        }
    }
    
    private function ifThisQuestionDataChanged(){
        
        $respId = mysqli_real_escape_string ($this->connection, $this->respId);
        $qIdToCheck = mysqli_real_escape_string ($this->connection, $this->id);

        // пойди в базу проверь, зависят ли от этого вопроса другие:
        $queryQConditionSet = "SELECT * FROM `qconditions` WHERE `relatedQId`='$qIdToCheck'";
        $resultQConditionSet = mysqli_query($this->connection, $queryQConditionSet);

        // если да, проверь, изменились ли данные по нему
        if (mysqli_num_rows($resultQConditionSet) && isset($this->qData)){
            
            // для разных видов отправки в пост прописать разные функции
            if (isset($_POST['name'])){
                echo 'hey';
                foreach ($_POST['name'] as $key=>$value){
                    $arrayPost[$value]='true';
                }
            } else {
                foreach ($_POST as $key=>$value){
                    if ($key == 'next')
                        continue;
                    $arrayPost[$key]=$value;
                    
                }
            }
            
            $diff1 = array_diff_assoc ($arrayPost, $this->qData);
            $diff2 = array_diff_assoc ($this->qData, $arrayPost);
            // если данные изменились, удали все, что идет после этого вопроса:
            if (count($diff1) > 0 or count($diff2) > 0){
                // если да и его значение изменилось, удали все, что идет после этого вопроса из базы
                $queryFindQToDelete = "SELECT * FROM `data` WHERE `respId` = '$respId' AND `qId` > '$qIdToCheck' ";
                $connectionFindQ = mysqli_query($this->connection, $queryFindQToDelete);

                while ($findQRow = mysqli_fetch_assoc($connectionFindQ)){
                    $qIdToDelete = mysqli_real_escape_string ($this->connection, $findQRow["qId"]);
                    $queryToDelete = "DELETE FROM `data` WHERE `respId`='$respId' AND `qId`='$qIdToDelete' ";
                    $deleteResult = mysqli_query ($this->connection, $queryToDelete);
                }
            }
        }
    }
    

// destructor
// тут сделать коннекшн клоз
    
}
?>