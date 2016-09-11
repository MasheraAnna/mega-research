<?php

include "config/config.php";
include "class/Question.php";
require_once 'vendor/autoload.php';

// создали объект вопрос, он подключился к базе и получил текст вопроса и варианты ответа по id
// и вывел все это на экран
$question = new Question(HOST, USER, PASSWORD, DB);

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
    'debug' => true
));

if(question.qView != 'last') {
    $tpl_name = 'index.html';
} else {
    $tpl_name = 'bb.html';
}

$template = $twig->loadTemplate('index.html');

echo $template->render(array(
    "question" => $question->question,
    "variantes" => $question->variantes,
    "scale" => $question->scale,
    "qData" => $question->qData,
    "name" => $question->name
));


/*************************** Задачи:
 * 
 * 10) добавляет кнопки "ничего из перечисленного" и "другое" с полем, если нужно
 * может быть сделать отдельные шаблоны для этих кнопок?
 * 
 * 7) где нужно делать закрытие соединения? destructor? внизу индекса и процесса - сделать закрытие соединения!!!!!!!!!!!!!!!
 */

/************************ Вопросики:
 * 1) как поступать с ошибками?
 * нужно ли их присваивать переменным? или просто писать throw? или die? чем они отличаются?
 * нужно ли генерить какое-то событие? чувствую где-то здесь должны быть кол-бэки, но не понимаю, где)
 * 
 * 2) куда нужно поправилам вставить обработчики ошибок? еще это называется "бросать исключение"
 * и как это сделать?
 * 
 * 3) ответить на вопросы в example from youtube
 * 
 * 4) Зачем мы в public function showView () делаем $question=$this?
 * я понимаю, что без него не работает, но что это такое не понимаю.
 * 
 * 5) где делать коннекшн клоз
 * 
 * 6) как по человечески прописать путь к папке твиг, которая поставилась сама (на c в users)?
 *
 * 
****************************/

?>