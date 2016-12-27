<?php


// проверить перезапись ответов - она не работает, и все! можно тесты писать!!!!
/* еще:
- напистать JS
- сдалать дизайн
- сделать try catch
- добавить возможность вписывать вопросы в базу
и кажется все!!!!
*/

class Question {
 
    public  $question = array();
    public  $variantes = array();
    public  $scale = array();
    private $connection;
    private $respId;
    public  $qData = array();
    private $lastQuestionAsked;
    public  $name = array();
    
    
    
    public function __construct($dbhost, $dbuser, $dbpassword, $dbname){
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (mysqli_connect_errno()) {
            die ("Database connection failed: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
        }
        mysqli_set_charset($this->connection,"utf8");        
        $this->respId = $this->getUserID();
        
        // проверяем на наличие двух ключевых параметров: qid и respId
        // в зависимости от них определяем, какой вопрос задать респонденту
        
        $testQIndex = filter_input (INPUT_GET, 'qIndex', FILTER_SANITIZE_NUMBER_INT);
         
        if ($testQIndex && $this->respId){

            $this->getLastQuestionAsked();
            
            if ($testQIndex == ($this->lastQuestionAsked+1) or $testQIndex < ($this->lastQuestionAsked+1)){
                
                // считай, что следующим задаем вопрос, который получили из GET
                // сходи в базу, проверь, можем ли мы показать этот вопрос.

                $testQIndex = $this->ifAskThisQ($testQIndex);

                $qIndex = $testQIndex;
                $this->question["qIndex"]= $testQIndex;
                $this->question["id_test"] = $this->getQid($qIndex);
                
            } else {
                
                // считаем, что следующим задаем вопрос, который идет следующим в базе по порядку
                $qIndex = $this->lastQuestionAsked+1;
                // сходи в базу, проверь, можем ли мы задать этот вопрос в соответствии с условиями
                $nextQIndex = $this->ifAskThisQ($qIndex);
                $qIndex = $nextQIndex;
                $this->question["qIndex"]= $nextQIndex;
                $this->question["id_test"] = $this->getQid($qIndex);
            }
        } else if ($testQIndex && !$this->respId){
        
            $qIndex = 1;
            $this->question["qIndex"] = 1;
            $this->question["id_test"] = $this->getQid($this->question["qIndex"]);
        
        } else if ($this->respId) {

            // вот эта функция должна возвращать qIndex а не qId
            $this->getLastQuestionAsked();
            // проверь, можем ли мы задать этот вопрос!
            $testQIndex = $this->lastQuestionAsked+1;
            $qIndex = $this->ifAskThisQ($testQIndex);
            $this->question["qIndex"]=$qIndex;
            $this->question["id_test"] = $this->getQid($this->question["qIndex"]);
        
        } else {

            $qIndex = 1;
            $this->question["qIndex"]= 1; 
            $this->question["id_test"] = $this->getQid($this->question["qIndex"]);
        
        }


        // заполним свойства объекта:
        $this->fetchStep($qIndex);
        $this->fetchVariantes();
        
        // получим из базы ответы на этот вопрос, если он уже задавался
        $this->getThisQData();
        $this->fetchName();
    }
    
    
    // методы:
    
    // эта функция вытаскивает id в зависимости от индекса
    private function getQid($qIndex){
        $queryForQid = "SELECT * FROM `questions` WHERE `qIndex` = '$qIndex' ";
        $resultQid = mysqli_query($this->connection, $queryForQid);
        $this->question["id_test"] = mysqli_fetch_assoc($resultQid)['id_test'];
    }


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
            
            $nextQIndex = mysqli_real_escape_string($this->connection, $nextQuestion);
            $respId = mysqli_real_escape_string($this->connection, $this->respId);
            

            $queryConditionExists = "SELECT * FROM `qconditions` INNER JOIN `questions` 
            ON qconditions.qId = questions.id_test WHERE questions.qIndex = '$nextQIndex' ";


            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);


            if (mysqli_num_rows($resultConditionExists)){
                $queryToCheck = " SELECT answers.qId, qconditions.conditionType, qconditions.relatedAId, qconditions.equals, data.aId, data.answer FROM `qconditions` 
                INNER JOIN `data` ON qconditions.relatedAId = data.aId AND qconditions.equals = data.answer
                INNER JOIN `answers` ON answers.id = data.aId 
                INNER JOIN `questions` ON questions.id_test = qconditions.qId
                WHERE data.respId = '$respId' AND questions.qIndex = '$nextQIndex' ";

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
        

        $queryQid = "SELECT * FROM `questions` WHERE `qIndex` = '$nextQuestion' ";
        $resultQid = mysqli_query($this->connection, $queryQid);
        $rowQid = mysqli_fetch_assoc($resultQid);
        $this->question["id_test"] = $rowQid['id_test'];
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
            
            $queryConditionExists = "SELECT * FROM `qconditions` 
                                    INNER JOIN `questions` ON qconditions.qId = questions.id_test
                                    WHERE questions.qIndex = '$nextQ' ";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
            
            if (mysqli_num_rows($resultConditionExists)){

                $queryToCheck = "SELECT * FROM `qconditions`
                            INNER JOIN `data` ON  qconditions.relatedAId  = data.aId AND qconditions.equals = data.answer
                            INNER JOIN `questions` ON qconditions.qId = questions.id_test
                            WHERE questions.qIndex = '$nextQ' AND data.respId = '$respId'";

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
    private function fetchStep ($qIndex){
        // проверяем на безопасность содержание куки
        $qIndex = mysqli_real_escape_string($this->connection, $qIndex);
        $query = "SELECT * FROM `questions` WHERE `qIndex`='$qIndex'";
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

        $qId = mysqli_real_escape_string($this->connection,$this->question["id_test"]);
         

        // пойди в базу, проверь, есть ли у вариантов этого вопроса условие.
        $queryForVariantes = "SELECT answers.id, answers.answer_text, answers.answerIndex FROM `answers` 
                        INNER JOIN `aconditions` ON answers.id = aconditions.aId 
                        WHERE aconditions.id AND answers.qId = '$qId' ORDER BY answers.answerIndex";
        $resultVariantes = mysqli_query($this->connection, $queryForVariantes);
        
        // если условие есть
        if (mysqli_num_rows($resultVariantes)){
            
            $respId = mysqli_real_escape_string($this->connection, $this->respId);
            $qId = mysqli_real_escape_string($this->connection,$this->question["id_test"]);

            // выбираем те варианты, у которых есть условие и оно выполняется
            $queryForVConditions = "SELECT aconditions.aId, answers.answer_text, answers.answerIndex FROM `aconditions` 
                            INNER JOIN `data` ON data.aId = aconditions.relatedAId AND data.answer = aconditions.equals 
                            INNER JOIN `answers` ON aconditions.aId = answers.id  
                            WHERE answers.qId = '$qId' AND data.respId = '$respId'";

            $resultVConditions = mysqli_query($this->connection, $queryForVConditions);

            if (mysqli_num_rows($resultVConditions)){
                while ($rowVConditions = mysqli_fetch_assoc($resultVConditions)){
                    $currentVariantes[$rowVConditions['aId']] = ['answer_text' => $rowVConditions['answer_text'], 'answerIndex' => $rowVConditions['answerIndex']];
                }
            }

            // выбираем те варианты, у которых нет условия
            $queryForVNoConditions = "SELECT answers.id, answers.answer_text, answers.answerIndex FROM `answers` 
                            LEFT OUTER JOIN `aconditions` ON aconditions.aId = answers.id  
                            WHERE aconditions.id IS NULL AND answers.qId = '$qId'";
            $resultForVNoConditions = mysqli_query($this->connection, $queryForVNoConditions);

            if (mysqli_num_rows($resultForVNoConditions)){
                while ($rowVNoConditions = mysqli_fetch_assoc($resultForVNoConditions)){
                    $currentVariantes[$rowVNoConditions['id']] = ['answer_text' => $rowVNoConditions['answer_text'], 'answerIndex' => $rowVNoConditions['answerIndex']];
                }
            }


        } else {
            $qId = mysqli_real_escape_string($this->connection,$this->question["id_test"]);
            $queryForVariantes = "SELECT answers.id, answers.answer_text, answers.answerIndex FROM `answers` WHERE answers.qId = '$qId'";
            $resultVariantes = mysqli_query($this->connection, $queryForVariantes);
            while ($row = mysqli_fetch_assoc($resultVariantes)){
                $currentVariantes[$row['id']] = ['answer_text' => $row['answer_text'], 'answerIndex' => $row['answerIndex']]; 
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

        $qId = mysqli_real_escape_string($this->connection, $this->question["id_test"]);
        $query = " SELECT * FROM `scales` WHERE `qId`='$qId' ";
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
        $qId = mysqli_real_escape_string ($this->connection, $this->question["id_test"]);
        
        $getDataQuery = "SELECT * FROM `data` 
                        INNER JOIN `answers` ON data.aId = answers.id 
                        WHERE data.respId = '$respId' AND answers.qId = '$qId'";
        
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
        $queryForName = "SELECT * FROM `data` INNER JOIN `answers` ON data.aId = answers.id WHERE data.respId = '$respId' AND answers.qId = 2";

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
        
        $qId = mysqli_real_escape_string ($this->connection, $this->question["id_test"]);
        $qIndex = mysqli_real_escape_string ($this->connection, $this->qIndex);
        $respId = mysqli_real_escape_string($this->connection, $this->respId);        
        
        // Проверяем, есть ли текущий вопрос уже в базе, если да - удаляем его

        $query = "SELECT data.id FROM `data` 
                INNER JOIN `answers` on data.aId = answers.id
                WHERE answers.qId = '$qId' AND data.respId = '$respId'";
        $result = mysqli_query ($this->connection, $query);
        
        
        if ($this->qData){

            while ($row = mysqli_fetch_assoc($result)){
                // удаление из базы
                $stringId = mysqli_real_escape_string($this->connection, $row["id"]);
                
                $queryToDelete = "DELETE FROM `data` WHERE `data`.`id` = $stringId";
                $deleteResult = mysqli_query($this->connection, $queryToDelete);
            }
        }

        // кстати, нужно все массивы post тоже обработать, чтобы не обращаться к ним непосредственно.
        // вопрос - как тут экранировать символы? у меня же массив? filter_input не применяется к массиву


        if (isset ($_POST['name'])){
            foreach ($_POST['name'] as $key => $value){
                $query = "INSERT INTO `data` (`respId`,`aId`,`answer`)"
                        . "VALUES ('$respId','$value','true')";
                $result = mysqli_query($this->connection, $query);
            }
        } else {

            foreach ($_POST as $key => $value) {
                $query = "INSERT INTO `data` (`respId`,`aId`,`answer`) VALUES ('$respId','$key','$value')";                
                $result = mysqli_query($this->connection, $query);
            }
        }
    }
    
    
    private function getLastQuestionAsked(){
        // обратимся в базу, вытащим все записи текущего респондента.
        
        $respId = mysqli_real_escape_string($this->connection, $this->respId);

        $query = "SELECT `qIndex` FROM `questions`
        INNER JOIN `ANSWERS` ON  questions.id_test = answers.qId
        INNER JOIN `data` ON data.aId = answers.id WHERE data.respId = '$respId' ORDER BY `qIndex` ";
        // вот тут нужно обратиться параллельно в таблицу answers и вытащить оттуда qId

        $result = mysqli_query ($this->connection, $query);
        
        if (mysqli_num_rows($result)){
        
        // сложим все полученные записи в массив $askedQestionsArray
            while ($row = mysqli_fetch_assoc($result)){
                
                $askedQestionsArray[]=$row['qIndex'];
            }
            // определим, какой вопрос был задан последним, для этого сортируем массив по убыванию
            $maxKey = max(array_keys($askedQestionsArray));
            $lastAskedQuestion = $askedQestionsArray[$maxKey];
            
            if ($lastAskedQuestion){
                $this->lastQuestionAsked = $lastAskedQuestion;
            }
        }
    }
    
    private function ifThisQuestionDataChanged(){
        
        $respId = mysqli_real_escape_string ($this->connection, $this->respId);
        $qIdToCheck = mysqli_real_escape_string ($this->connection, $this->question["id_test"]);

        // пойди в базу проверь, зависят ли от этого вопроса другие:
        $queryQConditionSet = " SELECT * FROM `qconditions` 
                    INNER JOIN `answers` ON qconditions.relatedAId = answers.id 
                    WHERE answers.qId ='$qIdToCheck'";
        
        $resultQConditionSet = mysqli_query($this->connection, $queryQConditionSet);

        // если да, проверь, изменились ли данные по нему
        if (mysqli_num_rows($resultQConditionSet) && isset($this->qData)){
            
            // для разных видов отправки в пост прописать разные функции
            if (isset($_POST['name'])){
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
                
                $queryFindQToDelete = "DELETE data.* FROM `data`
                            INNER JOIN `answers` on data.aId = answers.id 
                            WHERE data.respId = '$respId' AND answers.qId > '$qIdToCheck' ";
                $connectionFindQ = mysqli_query($this->connection, $queryFindQToDelete);

            }
        }
    }
    

// destructor
// тут сделать коннекшн клоз
    
}
?>