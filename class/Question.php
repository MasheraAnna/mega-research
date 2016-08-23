<?php
class Question {
    private $viewFile; 
    private $question = array();
    public  $variantes = array();
    private $connection;
    private $userId;
    
    // при создании объекта класса DataBase выполняется подключение к базе    
    public function __construct($dbhost, $dbuser, $dbpassword, $dbname){
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (mysqli_connect_errno()) {
            die ("Database connection failed: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
        }
        mysqli_set_charset($this->connection,"utf8");

        $this->userId = $this->getUserID();
        // здесь нужно сделать $this->getNextQId(), а qId можно получить уже не из get, а
        // обратившись в базу проверить, какой был последний вопрос
        // наверное, сначала нужно записать данные в базу, а потом уже определять, какой вопрос следующий.
        
        
        if (isset($_GET['qId']) && $this->userId){
            $qId = $_GET['qId'];
        } else if ($this->userId) {
            // это тот случай, когда респ заходит на сайт и у него есть куки
            $qId = 1;
            $this->question["id"]=1; 
        } else {
            $qId = 1;
            $this->question["id"]=1; 
        }
        
        // вытаскиваем из базы текст вопроса и ответы
        $currentQ = $this->fetchStep($qId);
        ($currentQ);
        if ($currentQ){
            $this->question = $currentQ;
        }
        $currentVariantes = $this->fetchVariantes();
        if ($currentVariantes){
            $this->variantes = $currentVariantes;
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
    private function getNextQId(){
        
        // обратимся в базу, вытащим все записи текущего респондента.
        $userId = $this->userId;
        $query = "SELECT `qId` FROM `data` WHERE `userId` = $userId";
        $result = mysqli_query ($this->connection , $query);        
       
        // сложим все полученные записи в массив $askedQestionsArray
        $i=0;
        while ($row = mysqli_fetch_assoc($result)){
            $askedQestionsArray[$i]=$row['qId'];
            $i++;
        }
        // определим, какой вопрос был задан последним, для этого сортируем массив по убыванию
        sort($askedQestionsArray);
        $maxKey = max(array_keys($askedQestionsArray));
        $lastAskedQuestion = $askedQestionsArray[$maxKey];
        
        // значит следующий вопрос:
        $nextQuestion = $lastAskedQuestion + 1;
        
        // ходим по циклу, пока не найдем выполняющееся условие
        $showQuestion = false;
        while ($showQuestion == false){
            // проверим, есть ли у этого вопроса условие? Запишем результат проверки в переменную $showQuestion
            $queryConditionExists = "SELECT * FROM `conditions` WHERE `qId` = $nextQuestion";
            $resultConditionExists = mysqli_query($this->connection, $queryConditionExists);
            // чтобы задать условие используем функцию подсчета строк:
            // если $resultConditionExists вернулся не пустым, то пройдемся по нему циклом
            if (mysqli_num_rows($resultConditionExists)){

                // проверим выполняется ли условие

                // **********************************************************************************
                // вот этот цикл обязательно усложнится, когда добавятся другие типы условий!!!!!!!!!!!!!!!!
                $i=0;
                while ($row = mysqli_fetch_assoc($resultConditionExists)){
                    $conditionsArray = preg_split('/=/' , $row['cond']);

                    //идем в базу и проверяем, какой ответ вписал респондент
                    $userId = $this->userId;
                    $qId = $conditionsArray[0];
                    $checkDataQuery = "SELECT `answer` FROM `data` WHERE `qId` = $qId  AND `userId` = $userId";  
                    $checkDataResult = mysqli_fetch_assoc(mysqli_query($this->connection, $checkDataQuery));
                    if ($checkDataResult['answer'] == $conditionsArray[1]){
                        $showQuestion = true;
                    } else {
                        $nextQuestion = $nextQuestion+1;
                        $showQuestion = false;
                        continue(2);
                    }
                    $i++;
                }
            } else {
                $showQuestion = true;
            }
        }
    // метод должен возвращать id следующего вопроса
    return $nextQuestion;
    }
    
    // эта функция делает доступной переменные в массивах-свойствах класса.
    // обязательно почитать про эту штуку!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function __get( $name ){
        if (array_key_exists($name, $this->question)){
            return $this->question[$name];
        }
    }

    // эта функция из базы текст текущего вопроса
    private function fetchStep ($qId){
        // проверяем на безопасность содержание куки
        $qId = mysqli_real_escape_string($this->connection, $qId);
        $query = "SELECT * FROM `questions` WHERE `id`='$qId'";
        $qeryResult = mysqli_query($this->connection, $query);
        $currentQ = mysqli_fetch_assoc($qeryResult);
        return $currentQ;
    }
    
    // эта функция получает из базы варианты ответа для текущего вопроса
    // и убирает их в массив, ключи которого - это id для инпутов
    private function fetchVariantes (){
        $query = "SELECT * FROM `answers` WHERE `Qid`='$this->id'";
        $queryResult = mysqli_query($this->connection, $query);
        $i=0;
        while ($row = mysqli_fetch_assoc($queryResult)){
            $i++;
            $currentVariantes[$i]=$row['answer'];
        }
        return $currentVariantes;
    }

    // эта функция получает из базы варианты ответа для текущего вопроса
    private function fetchScale (){
        $query = "SELECT * FROM `scales` WHERE `Qid`='$this->id'";
        $queryResult = mysqli_query($this->connection, $query);
        // вот тут нужно понять, как быть с ассоциативным массивом
        
    }    
    
    // выводит на экран шаблон, в который вставляет текст вопроса (в зависимости от типа вопроса)
    public function showView (){
        // что делает эта строчка?
        
        $question=$this;
        ob_start();
        // сходи тут в базу, определи, какой у нас вью
        $query = "SELECT `qView` FROM `questions` WHERE `id`=".$this->id;
        $result = mysqli_query($this->connection, $query);
        $resultArray = mysqli_fetch_assoc($result);
        $qView = $resultArray['qView'];
        $this->viewFile = $qView;
        include "./views/".$qView.".php";
        return ob_end_flush();
    }    

    // Эта функция отправляет данные в базу и в сессию
    function sendToDB(){
        if (!$this->userId){
            $startDate = date(DATE_RFC2822);
            $query = "INSERT INTO `users` (`userId`,`startTime`) VALUES (UUID(),'$startDate')";
            $queryResult = mysqli_query($this->connection, $query);
            $stringId = mysqli_insert_id($this->connection);
            $userIdQuery = "SELECT `userId` FROM `users` WHERE `id` = '$stringId'";
            $userIdQueryResult = mysqli_query($this->connection, $userIdQuery);
            $userIdarray = mysqli_fetch_assoc($userIdQueryResult);
            $userId = $userIdarray['userId'];
            if ($userId){
                $this->userId = $userId;
                $cookie = setcookie("userId", $userId, time() + 3600);
            }
        }

        // отправка данных в базу в цикле
        for ($i=0; $i<count($this->variantes); $i++) {
            $userId = $this->userId;
            $qId = $this->id;
            $answerCount = $i+1;
            $qName = $this->id.'_'.$answerCount;
            
            // если в массиве $_POST есть данные по этому id и номеру ответа, 
            // то отправь их в базу 
            if (isset ($_POST["$qName"])){
                $answer = $_POST["$qName"];
                $query = "INSERT INTO `data` (`userId`,`qId`,`answerCount`,`answer`) "
                        . "VALUES ('$userId','$qId','$answerCount','$answer')";
                $result = mysqli_query($this->connection, $query);
                
            }
        }

    }
// destructor
// тут сделать коннекшн клоз
    
}
?>