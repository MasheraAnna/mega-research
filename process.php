<?php
include "config/config.php";
include "class/Question.php";

$question = new Question(HOST, USER, PASSWORD, DB);

$CurrentQId = filter_input (INPUT_GET, 'qId', FILTER_SANITIZE_NUMBER_INT);
if (isset($_POST['next'])){    
    $question->sendToDb();
    $nextQuestion = $CurrentQId + 1;
    
    $nextQId = $question->ifAskThisQ($nextQuestion);
    
} else if (isset($_POST['prev'])&& $question->id > 1){
    $nextQId = $question->getPrevQId ($CurrentQId);
} else {
    $nextQId = 1;
}

header("Location:question$nextQId");
die();
?>

