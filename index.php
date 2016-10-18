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

if($question->qView != 'last') {
    $tpl_name = 'index.html';
} else {
    $tpl_name = 'bb.html';
}

$template = $twig->loadTemplate($tpl_name);

echo $template->render(array(
    "question" => $question->question,
    "variantes" => $question->variantes,
    "scale" => $question->scale,
    "qData" => $question->qData,
    "name" => $question->name
));






/*************************** Задачи:
 * 
 * 1) добавляет "другое" с полем, прописать отправку данных для этой кнопки, и сделать функцию postDataReformat,
 * которая будет вытаскивать данные из поста и переформатировать их для отправки в базу
 * 
 * 2) где нужно делать закрытие соединения? destructor? внизу индекса и процесса - сделать закрытие соединения!!!!!!!!!!!!!!!
 * 
 * 3) написать форму добавление вопросов
 * 
 * 4) Поменять индексную страничку и наблоны сайта в целом, сделать переходы по страницам, 
 * проанализировать аналоги для этого
 * 
 * 5) написать тесты
 * 
 * 6) сделай через aId все. qId - убей
 * 
 * 7)  * погуглить "обработка исключений в php"
 * 
 * сначала нужно научиться исключения ловить: try - catch
 * действия, которые прописываем через try/catch:
 * 
 * коннекшн к базе

 * обработать при помощи трай-кетч все возможные ошибки в базе * 
 * log - журнал 
 * 
 * 8) сделать коннекшн клоз там, где деструктор класса
  
 */

/************************ Вопросики:
 * 1) что такое less - зачем он нужен, что он там компилит?) и scss так же.
 * 
 * 
 *
 *
 *
 *
****************************/

?>