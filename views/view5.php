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

        <?=$question->qNum.". ".$question->qText?>
        <br><br>
        <form action='process.php?qId=<?=$question->id?>' method='post'>
            <table border="1">
                <?php if (isset ($question->variantes)):?>
                    <tr>
                        <td></td>
                        <?php foreach ($question->scale as $keyScale => $valueScale):?>    
                            <td>
                                <?=$valueScale ?>
                            </td>
                        <?php endforeach;?>
                    </tr>
                
                    <?php foreach ($question->variantes as $key => $value) :?>
                        <tr>
                            <td>
                                <?=$value;?>
                            </td>
                            <?php foreach ($question->scale as $keyScale => $valueScale):?>
                                <td>    
                                    <input name ="<?=$key?>" id ="<?=$keyScale?>" type='radio' value="<?=$keyScale?>">
                                </td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </table>

            <br>
            
            <button name = "next" id="next" type="submit" style="width: 180px" value="next"> Следующий вопрос>> </button></br></br>
            <button name = "prev" id="prev" type="submit" style="width: 180px" value="back"> <<Предыдущий вопрос </button>
        </form>
<!--Это в футер-->
        
        
    </body>
</html>
