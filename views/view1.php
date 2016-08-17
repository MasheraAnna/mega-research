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
        <form action='process.php' method='post'>
            <?php if (isset ($currentAnswers)):?>
                <table>
                    <?php 
                        $i=0;
                        while ($row = mysqli_fetch_assoc($currentAnswers)):?>
                        <tr>
                            <td>
                                <?php $i++;
                                echo $row["answer"]?>
                            </td>
                            <td>
                                <input type='text' name='<?=$row["qId"]."_".$i?>' id='<?=$row["qId"]."_".$i?>'>
                            </td>
                        </tr>
                    <?php endwhile; ?>   
                </table>    
            <?php endif;?>

<!--
if ($row['type'] == 'text') {
    require('text.php');
} else if ($row['type'] == 'select') {
    require('select.php');
}
-->          

            <br><br>
            <input type='hidden' name='qId' id='qId' value='<?=$question->id?>'>
            <button name = "next" id="next" type="submit" style="width: 180px" value="next"> Следующий вопрос>> </button></br></br>
            <button name = "prev" id="prev" type="submit" style="width: 180px" value="back"> <<Предыдущий вопрос </button>
        </form>
<!--Это в футер-->
        
        
    </body>
</html>
