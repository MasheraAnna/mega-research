<?php

include "config/config.php";
echo 'this is test page'."<br>";

class Question {
    private $viewFile = 'view1'; // заменить это на функцию !!!!!!!!!!!!!!!!!!!!!

    private $question = array();
    public  $variantes = array();
    private $connection;

    private $userId=1;
    
    // при создании объекта класса DataBase выполняется подключение к базе    
    public function __construct($dbhost, $dbuser, $dbpassword, $dbname){
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        if (mysqli_connect_errno()) {
            die ("Database connection failed: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
        }
        mysqli_set_charset($this->connection,"utf8");
        
        }
    
    public function getNextQId(){
        
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
            print_r($resultConditionExists);
            // если $resultConditionExists вернулся не пустым, то пройдемся по нему циклом
            if (mysqli_num_rows($resultConditionExists)){
                echo "there is a condition.<br>";

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
                        echo "условие выполняется.<br>";
                        $showQuestion = true;
                    } else {
                        echo "условие не выполняется.<br>";
                        $nextQuestion = $nextQuestion+1;
                        $showQuestion = false;
                        continue(2);
                    }
                    $i++;
                }

            echo $showQuestion;
            } else {
                $showQuestion = true;
                echo "there is no condition";
            }
        }
    // метод должен возвращать id следующего вопроса
    return $nextQuestion;
    }
}

$question = new Question(HOST, USER, PASSWORD, DB);
$nextQId = $question->getNextQId();
var_dump($nextQId);
echo $nextQId;

?>

