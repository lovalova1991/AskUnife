<!DOCTYPE html>

<html>
    <style>
            .table{
            font-family:Arial, Helvetica, sans-serif;
            color: black;
            font-size: 16px;
            text-shadow: 1px 1px 0px #fff;
            background:  #fff;
            margin:20px;
            border:#ccc 1px solid;
            width: 80%;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            border-radius:3px;
            border-collapse: collapse;
            -moz-box-shadow: 0 1px 2px #d1d1d1;
            -webkit-box-shadow: 0 1px 2px #d1d1d1;
            box-shadow: 0 1px 2px #d1d1d1;
        }
        .AnswerTable
        {
            table-layout:fixed;
            width:20px;
            word-wrap:break-word;
            font-family:Arial, Helvetica, sans-serif;
            color: black;
            font-size:14px;
            text-shadow: 1px 1px 0px #fff;
            background:  menutext;
            margin-left: 100px;
            margin-top: 15px;
            border:#ccc 1px solid;
            width: 75%;
            border-bottom: 0px;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            border-radius:3px;
            border: 1px solid black;
            border-collapse: collapse;
            border-top: none;
            -moz-box-shadow: 0 1px 2px #d1d1d1;
            -webkit-box-shadow: 0 1px 2px #d1d1d1;
            box-shadow: 0 1px 2px #d1d1d1;
        }
        .answertitle{
            width: 200px;
            text-align: left;
            text-height: 20px;
            font-size: 20px;
        }
        .answertext{
            width: 600px;
            height: 150px;
            text-align: left;
            text-height: 20px;
            font-size: 16px;
        }
    </style>
    <head>
        <meta charset="UTF-8">
        <title>Q_Details-AskUnife</title>
    </head>
    <center>
    <body>
        <?php
            require("config.php");
            require ("services.php");
            

            if(isset($_POST['q_id']))
            {
                //sostituire con un join
                $question_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.q_id='" . $_POST['q_id'] ."' AND questions.id_cat = categories.id_cat";
                $answer_query = "SELECT * FROM q_answers WHERE a_id='" . $_POST["q_id"] . "'";
                
                $db_question = mysqli_query($db, $question_query);
                $db_answer = mysqli_query($db, $answer_query);
                
                if($db_question)
                {
                    $question_row = mysqli_fetch_array($db_question);
                    
                    createQuestionsTable("user", $question_row['q_title'], $question_row['nome_cat'], $question_row['q_text'], $question_row['q_utente'], $_POST['q_id'], "answerpage");

                    createAnswerForm($question_row['q_id'], $_SESSION['user']);

                    $_SESSION['mod'] = $question_row['q_id'];
                        try 
                        {
                            while($a_row = mysqli_fetch_array($db_answer))
                            {
                                createAnswersTable($a_row['id'],$a_row['a_title'], $a_row['a_text'], $a_row['a_utente'], $a_row['time'],$a_row['a_id']);
                            }                            
                        } 
                        catch (Exception $ex) 
                        {
                            die("$ex");
                        }   
                }
                else
                {
                    echo 'errore';
                }  
            }
        ?>
    </body>
    </center>
</html>
