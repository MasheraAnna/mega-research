<?php
class Question {
    private $viewFile; 
    public  $question = array();
    public  $variantes = array();
    public  $scale = array();
    private $connection;
    private $userId;
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
        $this->userId = $this->getUserID();
        
        // проверяем на наличие двух ключевых параметров: qid и userId
        // в зависимости от них определяем, какой вопрос задать респонденту
        if (isset($_GET['qId']) && $this->userId){
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
        } else if ($this->userId) {
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
        if (isset($_COOKIE["userId"])){
            $userId = mysqli_real_escape_string($this->connection, $_COOKIE["userId"]);
            $query = "SELECT * FROM `users` WHERE `userId`='$userId'";
            $result = mysqli_query($this->connection, $query);
            if(mysqli_num_rows($result)) {
                return $userId;
            }
        }
        return false;
    }
    
    // эта функция получает id следующего вопроса
    public function ifAskThisQ($nextQuestion){
        
        // Проверим, есть ли у него условие и выполняется ли оно:
        // ходим по циклу, пока не найдем выполняющееся условие
        
        $showQuestion = false;
        while ($showQuestion == false){
            $nextQ = mysqli_real_escape_string($this->connection, $nextQuestion);
            $queryConditionExists = "SELECT * FROM `qconditions` WHERE `qId` = $nextQ";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
            
            if (mysqli_num_rows($resultConditionExists)){
                
                while ($row = mysqli_fetch_assoc($resultConditionExists)){
                    
                    $userId = $this->userId;
                    $qId = mysqli_real_escape_string($this->connection, $row["dependsOnQId"]);
                    $aIndex = mysqli_real_escape_string($this->connection, $row["dependsOnAIndex"]);
                    
                    // пойди в базу и по каждому варианту, проверь, есть ли он в базе
                    $checkDataQuery = "SELECT `answer` FROM `data` WHERE `qId` = '$qId' AND `userId` = '$userId'";  
                    $checkDataResult = mysqli_query($this->connection, $checkDataQuery);
                    
                    while ($checkDataRow = mysqli_fetch_assoc($checkDataResult)){
                        if ($row['conditionType'] == "ask question if"){        
                            if ($checkDataRow['answer'] == $row["equals"]){
                                $showQuestion = true;
                                continue(3);
                            } else {
                                $showQuestion = false;
                            }
                        }
                    }
                }
                // если не нашел выполняющегося условия, переходи к следующему вопросу
                if (!$showQuestion){
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
            $queryConditionExists = "SELECT * FROM `qconditions` WHERE `qId` = $prevQuestion";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
            
            if (mysqli_num_rows($resultConditionExists)){

                while ($row = mysqli_fetch_assoc($resultConditionExists)){

                    $userId = mysqli_real_escape_string($this->connection, $this->userId);
                    $qId = $row["dependsOnQId"];
                    $checkDataQuery = "SELECT `answer` FROM `data` WHERE `qId` = '$qId'  AND `userId` = '$userId'";  
                    $checkDataResult = mysqli_query($this->connection, $checkDataQuery);
                    
                    while ($checkDataRow = mysqli_fetch_assoc($checkDataResult)){
                        if ($row['conditionType'] == "ask question if"){
                            if ($checkDataRow['answer'] == $row['equals']){
                                $showQuestion = true;
                                continue(3);
                            } else {
                                $showQuestion = false;
                            }
                        }
                    }
                }
            } else {
                $showQuestion = true;
            }
            if (!$showQuestion){
                $prevQuestion = $prevQuestion - 1;
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
        $i=0;
        
        while ($row = mysqli_fetch_assoc($resultVariantes)){
            
            $i++;
            
            // обратись в базу, посмотри, есть ли у этого варианта условие,
            $qId = mysqli_real_escape_string($this->connection, $row["qId"]);
            $answerIndex = mysqli_real_escape_string($this->connection, $row["answerIndex"]);
            $queryForConditions = "SELECT * FROM `aconditions` WHERE `qId`='$qId' AND `answerIndex`='$answerIndex' ";
            $conditionsResult = mysqli_query($this->connection, $queryForConditions);
            
            if (mysqli_num_rows($conditionsResult)){
                
                $showVariante = false;
                
                // получили три условия    
                // если условия есть, то по каждому из них:
                while ($line = mysqli_fetch_assoc ($conditionsResult)){
                    
                    $userId = mysqli_real_escape_string($this->connection, $this->userId);
                    $conditionType = $line["aСonditionType"];
                    $qId = mysqli_real_escape_string($this->connection, $line['relatedQId']);
                    $aIndex = mysqli_real_escape_string($this->connection, $line["relatedAIndex"]);
                    $conditionValue = $line['equals'];
                    
                    // определи тип условия для этого атрибута
                    if (!$showVariante){
                        if ($conditionType = 'show attribute if chosen'){

                            // посмотри, какие данные лежат в базе по этому ответу
                            $conditionCheckQuery = "SELECT * FROM `data` WHERE "
                                    . "`userId` = '$userId' AND `qId`= '$qId' AND `answerIndex` = '$aIndex' ";
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
                    $currentVariantes[$row['answerIndex']]=$row['answer'];
                }
                
            } else {
                $currentVariantes[$row['answerIndex']]=$row['answer'];
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
        $userId = mysqli_real_escape_string ($this->connection, $this->userId);
        $qId = mysqli_real_escape_string ($this->connection, $this->id);
        $getDataQuery = "SELECT * FROM `data` WHERE `userId` = '$userId' AND `qId` = '$qId' ";
        $getDataResult = mysqli_query ($this->connection, $getDataQuery);
        while($dataRow = mysqli_fetch_assoc($getDataResult)){
            
            if ($this->question['sendToDbType']=='single'){
                $thisQData[$dataRow['qId']] = $dataRow['answer'];
            
            } else if ($this->question['sendToDbType']=='multiple'){
                $thisQData[$dataRow['answerIndex']] = $dataRow['answer'];
            }
        }
        if (isset($thisQData)){
        $this->qData = $thisQData;
        }
    }
    
    // эта функция выводит фио респондента
    public function fetchName(){
        $userId = mysqli_real_escape_string($this->connection, $this->userId);
        $queryForName = "SELECT * FROM `data` WHERE `userId`='$userId' AND `qId`='1'";
        $nameRusult = mysqli_query ($this->connection, $queryForName);
        while ($row = mysqli_fetch_assoc($nameRusult)){
            $name[$row['answerIndex']] = $row['answer'];
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
        if (!$this->userId){
            $startDate = date(DATE_RFC2822);
            $startDate = mysqli_real_escape_string($this->connection, $startDate);
            $query = "INSERT INTO `users` (`userId`,`startTime`) VALUES (UUID(),'$startDate')";
            $queryResult = mysqli_query($this->connection, $query);
            $stringId = mysqli_insert_id($this->connection);
            
            $userIdQuery = "SELECT `userId` FROM `users` WHERE `id` = '$stringId'";
            
            $userIdQueryResult = mysqli_query($this->connection, $userIdQuery);
            $userIdArray = mysqli_fetch_assoc($userIdQueryResult);
            $userId = $userIdArray['userId'];
            if ($userId){
                $this->userId = $userId;
                $cookie = setcookie("userId", $userId, time() + 3600);
            }
        }
        
        // Проверка: был ли текущий вопрос условием для других вопросов?
        
        $userId = mysqli_real_escape_string ($this->connection, $this->userId);
        $qIdToCheck = mysqli_real_escape_string ($this->connection, $this->id);
        
        $allDependancesDeleted = false;

        // пойди в базу проверь, зависят ли от этого вопроса другие:
        $queryQConditionSet = "SELECT * FROM `qconditions` WHERE `dependsOnQId`='$qIdToCheck'";
        $resultQConditionSet = mysqli_query($this->connection, $queryQConditionSet);

        if (mysqli_num_rows($resultQConditionSet) && isset($this->qData)){
            
            // для каждого из полученных их таблицы "qconditions" условий
            // пройдемся по массиву qData, проверим, совпадают ли ответы в нем с тем, что есть в массиве $_POST
            while ($condition = mysqli_fetch_assoc ($resultQConditionSet)){

                $diff1 = array_diff_assoc ($_POST, $this->qData);
                $diff2 = array_diff_assoc ($this->qData, $_POST);
                // если данные не совпадают:
                if (count($diff1) > 1 or count($diff2) > 0){
                    echo "hey";
                    // если да и его значение изменилось, удали все, что идет после этого вопроса из базы
                    $queryFindQToDelete = "SELECT * FROM `data` WHERE `userId` = '$userId' AND `qId` > '$qIdToCheck' ";
                    $connectionFindQ = mysqli_query($this->connection, $queryFindQToDelete);

                    while ($findQRow = mysqli_fetch_assoc($connectionFindQ)){
                        $qIdToDelete = mysqli_real_escape_string ($this->connection, $findQRow["qId"]);
                        $queryToDelete = "DELETE FROM `data` WHERE `userId`='$userId' AND `qId`='$qIdToDelete' ";
                        $deleteResult = mysqli_query ($this->connection, $queryToDelete);
                    }
                }
            }            
        }
        
        
        
        $qId = mysqli_real_escape_string ($this->connection, $this->id);
        $userId = mysqli_real_escape_string($this->connection, $this->userId);        
        // Проверяем, есть ли текущий вопрос уже в базе, если да - удаляем его
        $query = "SELECT `answer`,`answerIndex`,`id` FROM `data` WHERE `qId` = '$qId' AND userId = '$userId' ";
        $result = mysqli_query ($this->connection, $query);
        if ($this->qData){
            while ($row = mysqli_fetch_assoc($result)){
                // удаление из базы
                $stringId = mysqli_real_escape_string($this->connection, $row["id"]);
                $queryToDelete = "DELETE FROM `data` WHERE `data`.`id` = $stringId";
                $deleteResult = mysqli_query($this->connection, $queryToDelete);
            }
        }
        
        // задай идентификаторы ответов уникальные, у тебя сократится число полей,
        // т.е. не нужно будет в базу отправлять номер вопроса, а нужно будет отправлять только id 
        // ответа, тогда малтипл и синг станут одинаковыми в плане отправки в базу - меньше сущностей - лучше!
        
        if ($this->sendToDbType == 'multiple'){
            // отправка данных в базу и в сессию в цикле
            foreach ($_POST as $key => $value) {
                    $query = "INSERT INTO `data` (`userId`,`qId`,`answerIndex`,`answer`)"
                            . "VALUES ('$userId','$qId','$key','$value')";
                    $result = mysqli_query($this->connection, $query);
            }
        } elseif ($this->sendToDbType == 'single') {
            $answer = mysqli_real_escape_string($this->connection, $_POST[$qId]);
            $query = "INSERT INTO `data` (`userId`,`qId`,`answer`)"
                    . "VALUES ('$userId','$qId','$answer')";
            $result = mysqli_query($this->connection, $query);
        }
    }
    
    
    private function getLastQuestionAsked(){
        // обратимся в базу, вытащим все записи текущего респондента.
        $userId = mysqli_real_escape_string($this->connection, $this->userId);
        $query = "SELECT `qId` FROM `data` WHERE `userId` ='$userId'";
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