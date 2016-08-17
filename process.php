<?php


// проверяем данные на безопасность
// отправляем в базу
// определяем следующий вопрос

// эта функция передаеномер вопрос,который нужно показать
// header("Location: /index.php?question=123&error=сам дурак");
// добавить error text - результат проверки при помощи пхп
// die(); - в конце кода на этой странице


include "config/config.php";
include "class/Question.php";

session_start();
$question = new Question(HOST, USER, PASSWORD, DB);

if (isset($_POST['next'])){
    $question->sendToDb($_POST['qId']);
    // получить степ
    // определить, какой вопрос следующий
    // определить, какой тип шаблона следующий
    $qId=$_POST['qId']+1; // это то же что id

} else if (isset($_POST['prev'])&& $_POST['qId']>1){
    // получить степ
    // определить, какой файл предыдущий
    // определить, какой тип шаблона предыдущий
    $qId=$_POST['qId']-1; // это то же что id

} else {
   // обработать ошибку
    // отправляем в базу данные о том, что опрос начался и получаем id респондента
}

header("Location: question$qId");
die();
?>

