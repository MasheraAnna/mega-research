<!DOCTYPE html>
<html>
    <head>
        <title>Questionnaire</title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' title='Questionnaire'>
        <link rel='stylesheet' href='stylesheets/styles.css' type='text/css'>
    </head>
    <body>
        Ваше учистие очень важно для нас! Пожалуйста, заполните анкету до конца.
        <br><br>
<!--Это в хедер-->    

        <?=$question->qNum.". ".$question->qText?>
        
        <br><br>
        <form action='process.php?qId=<?=$question->id?>' method='post'>
            <?php if (isset ($question->variantes)):?>
                <?php for ($i=0; $i<count($question->variantes); $i++):?>
                    <div>
                        <div class='q1'>
                            <?= $question->variantes[$i+1] ?>
                        </div>
                        <input name ="<?=$question->id."_".($i+1)?>" id ="<?=$question->id."_".($i+1)?>" type='text'>
                    </div>
                <?php endfor;?>
            <?php endif;?>         

            <br>
            
            <input type='hidden' name='qId' id='qId' value='<?=$question->id?>'>
            <button name = "next" id="next" type="submit" style="width: 180px" value="next"> Следующий вопрос>> </button></br></br>
            <button name = "prev" id="prev" type="submit" style="width: 180px" value="back"> <<Предыдущий вопрос </button>
        </form>
<!--Это в футер-->
        
        
    </body>
</html>
