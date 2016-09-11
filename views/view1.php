<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire</title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' title='Questionnaire'>
        <link rel='stylesheet' href='public/stylesheets/styles.css' type='text/css'>
        <script type="text/javascript" src="lib/jquery-3.0.0.min.js"></script>
        
    </head>
    <body>
        Ваше учистие очень важно для нас! Пожалуйста, заполните анкету до конца.
        <br><br>
<!--Это в хедер-->    

        <?=$question->qNum.". ".$question->qText;
        ?>
        
        <br><br>
        <form action='process.php?qId=<?=$question->id?>' method='post'>
            <?php if (isset ($question->variantes)):?>
                <?php foreach ($this->variantes as $key => $value) :?>
                    <div>
                        <div class='q1'>
                            <?=$value?>
                        </div>
                        <input name ="<?=$key?>" id ="<?=$key?>" type='text'
                        <?=(isset($_SESSION[$question->id."_".$key]))?"value=".$_SESSION[$question->id."_".$key]:''?>>
                    </div>
                <?php endforeach;?>
            <?php endif;?>

            <br>
            
            <button name = "next" id="next" type="submit" style="width: 180px" value="next"> Следующий вопрос>> </button></br></br>
            <button name = "prev" id="prev" type="submit" style="width: 180px" value="back"> <<Предыдущий вопрос </button>
        </form>
<!--Это в футер-->
        
        
    </body>
</html>
