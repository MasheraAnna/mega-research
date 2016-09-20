<?php
class Question {
    private $viewFile; 
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
        if (isset($_GET['qId']) && $this->respId){
            $this->getLastQuestionAsked();
            
            $testQId = filter_input (INPUT_GET, 'qId', FILTER_SANITIZE_NUMBER_INT);
            
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

            $queryConditionExists = "SELECT * FROM `qconditions` WHERE `qId` = $nextQ";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
                
            if (mysqli_num_rows($resultConditionExists)){
                
                $queryToCheck = "SELECT qconditions.qId, qconditions.conditionType, qconditions.relatedAId, "
                        . "qconditions.equals, data.qId as data_qId ,data.aId as data_aId, data.answer as data_answer "
                        . "FROM `qconditions` INNER JOIN `data` ON  qconditions.relatedAId  = data.aId "
                        . "AND qconditions.equals  = data.answer WHERE qconditions.qId = '$nextQ'";
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

            $queryConditionExists = "SELECT * FROM `qconditions` WHERE `qId` = $nextQ";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
                
            if (mysqli_num_rows($resultConditionExists)){
                
                $queryToCheck = "SELECT qconditions.qId, qconditions.conditionType, qconditions.relatedAId, "
                        . "qconditions.equals, data.qId as data_qId ,data.aId as data_aId, data.answer as data_answer "
                        . "FROM `qconditions` INNER JOIN `data` ON  qconditions.relatedAId  = data.aId "
                        . "AND qconditions.equals  = data.answer WHERE qconditions.qId = '$nextQ'";
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
        $queryForVariantes = "SELECT * FROM `answers` WHERE `Qid`='$qId' ORDER BY `answerIndex`";
        $resultVariantes = mysqli_query($this->connection, $queryForVariantes);
        
        while ($row = mysqli_fetch_assoc($resultVariantes)){
            
            // обратись в базу, посмотри, есть ли у этого варианта условие,
            $aId = mysqli_real_escape_string($this->connection, $row["id"]);
            $queryForConditions = "SELECT * FROM `aconditions` WHERE `aId`='$aId'";
            $conditionsResult = mysqli_query($this->connection, $queryForConditions);
            if (mysqli_num_rows($conditionsResult)){
                
                $showVariante = false;
                
                // получили условия    
                // если условия есть, то по каждому из них:
                while ($line = mysqli_fetch_assoc ($conditionsResult)){
                    
                    $respId = mysqli_real_escape_string($this->connection, $this->respId);
                    $conditionType = $line["aСonditionType"];
                    $aId = mysqli_real_escape_string($this->connection, $line['relatedAId']);
                    $conditionValue = $line['equals'];
                    
                    // определи тип условия для этого атрибута
                    if (!$showVariante){
                        if ($conditionType = 'show attribute if chosen'){

                            // посмотри, какие данные лежат в базе по этому ответу
                            $conditionCheckQuery = "SELECT * FROM `data` WHERE "
                                    . "`respId` = '$respId' AND `aId`= '$aId' ";
                            $conditionCheckResult = mysqli_query($this->connection, $conditionCheckQuery);

                            // Если в базе есть данные по этому запросу и они соответствуют условию
                            while ($array = mysqli_fetch_assoc ($conditionCheckResult)){
                                if ($array["answer"] == $conditionValue){
                                    $showVariante = true;
                                }
                            }
                        }
                    }
                }
                
                if ($showVariante){
                    $currentVariantes[$row['id']]=$row['answer']; // вот тут можно вставить массив, впринципе
                }
                
            } else {
                $currentVariantes[$row['id']]=$row['answer']; // вот тут можно вставить массив, впринципе
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
    
    // выводит на экран шаблон, в который вставляет текст вопроса (в зависимости от типа вопроса)
    public function showView (){
        // что делает эта строчка?
        $question=$this;
        
        ob_start();
        // сходи тут в базу, определи, какой у нас вью
        $qId = mysqli_real_escape_string($this->connection, $this->id);
        $query = "SELECT `qView` FROM `questions` WHERE `id`='$qId'";
        $result = mysqli_query($this->connection, $query);
        $resultArray = mysqli_fetch_assoc($result);
        $qView = $resultArray['qView'];
        $this->viewFile = $qView;
        include "./views/".$qView.".php";
        return ob_end_flush();
    }

    // Эта функция отправляет данные в базу и в сессию
    function sendToDB(){
        
        // проверяем, есть ли у респондента id, т.е. поставлены ли ему cookies
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
        
        // Проверка: был ли текущий вопрос условием для других вопросов?
        
        $respId = mysqli_real_escape_string ($this->connection, $this->respId);
        $qIdToCheck = mysqli_real_escape_string ($this->connection, $this->id);
        
        $allDependancesDeleted = false;

        // пойди в базу проверь, зависят ли от этого вопроса другие:
        $queryQConditionSet = "SELECT * FROM `qconditions` WHERE `relatedQId`='$qIdToCheck'";
        $resultQConditionSet = mysqli_query($this->connection, $queryQConditionSet);

        if (mysqli_num_rows($resultQConditionSet) && isset($this->qData)){
            
            // для каждого из полученных их таблицы "qconditions" условий
            // пройдемся по массиву qData, проверим, совпадают ли ответы в нем с тем, что есть в массиве $_POST
            while ($condition = mysqli_fetch_assoc ($resultQConditionSet)){

                $diff1 = array_diff_assoc ($_POST, $this->qData);
                $diff2 = array_diff_assoc ($this->qData, $_POST);
                // если данные не совпадают:
                if (count($diff1) > 1 or count($diff2) > 0){
                    
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
        
        foreach ($_POST as $key => $value) {
            if ($this->question['inputType'] == 'single'){
                $query = "INSERT INTO `data` (`respId`,`qId`,`aId`,`answer`)"
                        . "VALUES ('$respId','$qId','$value','true')";
            } elseif ($this->question['inputType'] == 'multiple'){
                $query = "INSERT INTO `data` (`respId`,`qId`,`aId`,`answer`)"
                        . "VALUES ('$respId','$qId','$key','$value')";                
            }
            $result = mysqli_query($this->connection, $query);
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


// destructor
// тут сделать коннекшн клоз
    
}
?>