<?php
class Question {
    public $connection;

    // при создании объекта класса DataBase выполняется подключение к базе    
    public function __construct($dbhost, $dbuser, $dbpassword, $dbname){
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
        /***********       вопросики    *************************************************/ 
        // а нужно ли эту ошибку присваивать какому-либо свойству класса? или так достаточно?
        // почему они пишут die или exit? а не просто echo? чтобы остановить выполнение скрипта?
        // а что будет если не остановить выполнение скрипта?
        
        if (mysqli_connect_errno()) {
            die ("Database connection failed: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
        }
    
    mysqli_set_charset($this->connection,"utf8");    
    }

    // эта функция из базы рекст текущего вопроса
    public function fetchStep ($qId){
        $query = "SELECT * FROM `questions` WHERE `id`='$qId'";
        $qeryResult = mysqli_query($this->connection, $query);
        $currentQ = mysqli_fetch_assoc($qeryResult);
        return $currentQ;
    }
    
    // эта функция получает из базы варианты ответа для текущего вопроса
    // и убирает из в массив, ключи которого - это id для инпутов
    public function fetchVariantes ($qId){
        $query = "SELECT * FROM `answers` WHERE `Qid`='$qId'";
        $queryResult = mysqli_query($this->connection, $query);
        return $queryResult;
    }

    // эта функция получает из базы варианты ответа для текущего вопроса
    function fetchScale ($qId){
        $query = "SELECT * FROM `scales` WHERE `Qid`='$qId'";
        $queryResult = mysqli_query($this->connection, $query);
        // вот тут нужно понять, как быть с ассоциативным массивом
        
    }    
    
    // выводит на экран шаблон, в который вставляет текст вопроса (в зависимости от типа вопроса)
    function showView($viewFile, $currentQ, $currentAnswers, $qId){
        ob_start();
        include "./views/".$viewFile.".php";
        return ob_end_flush();
    }    

    // Эта функция отправляет данные в базу и в сессию
    function sendToDB($qId){
        // проверяем, какой это вопрос - сингл или малтипл
        $currentQ = $this->fetchStep($qId);
        if ($currentQ["qType"]=="single"){
        } else if ($currentQ["qType"]=="multiple"){
            // запускаем в цикле отправку в сессию и в базу
            
        }
    }
}
?>