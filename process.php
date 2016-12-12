<?php
include "config/config.php";
include "class/Question.php";

$question = new Question(HOST, USER, PASSWORD, DB);

$CurrentQId = filter_input (INPUT_GET, 'qId', FILTER_SANITIZE_NUMBER_INT);
$next = filter_input(INPUT_POST, 'next', FILTER_SANITIZE_EMAIL);
$prev = filter_input (INPUT_POST, 'prev', FILTER_SANITIZE_EMAIL);

if ($next){

    $question->sendToDb();
    $nextQuestion = $CurrentQId + 1;
    $nextQId = $question->ifAskThisQ($nextQuestion);

} else if ($prev && $question->id > 1){

    $nextQId = $question->getPrevQId ($CurrentQId);
} else {

    $nextQId = 1;
}

header("Location:question$nextQId");
die();
?>

