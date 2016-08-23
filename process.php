<?php

include "config/config.php";
include "class/Question.php";

$question = new Question(HOST, USER, PASSWORD, DB);

if (isset($_POST['next'])){    
    $question->sendToDb();
    // вот тут должна быть функция, определяющая следующий вопрос.
    $qId = $question->id + 1;
    
} else if (isset($_POST['prev'])&& $question->id>1){
    // а тут должна быть функция, определяющая предыдущий вопрос.
    $qId = $question->id - 1;

} else {   
   $qId=1;
}

header("Location:question$qId");

die();
?>

