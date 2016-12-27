<?php
include "config/config.php";
include "class/Question.php";

$question = new Question(HOST, USER, PASSWORD, DB);

$CurrentQIndex = filter_input (INPUT_POST, 'qIndex', FILTER_SANITIZE_NUMBER_INT);
$next = filter_input(INPUT_POST, 'next', FILTER_SANITIZE_EMAIL);
$prev = filter_input (INPUT_POST, 'prev', FILTER_SANITIZE_EMAIL);


if ($next){

    $question->sendToDb();
    $nextQuestion = $CurrentQIndex + 1;
    $nextQIndex = $question->ifAskThisQ($nextQuestion);

} else if ($prev && $question->qIndex > 1){
    $nextQIndex = $question->getPrevQId ($CurrentQIndex);
} else {
    $nextQIndex = 1;
}

header("Location:question$nextQIndex");
die();
?>

