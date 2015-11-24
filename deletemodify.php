<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <style>
        ody{
            background-image: url("http://imageshack.com/a/img905/1294/932jbq.png");
            background-repeat: no-repeat;
            background-position: right center;
        }
        .title{
            width: 100px;
            height: 20px;
        }
        .textTitle{
            text-align: center;
            box-sizing: border-box;
            width: 400px;
            height: 30px;
            text-wrap: initial;
            font-size: 16px;
            font-family: sans-serif;
        }
        textarea{
            text-align: left;
            box-sizing: border-box;
            width: 700px;
            height: 200px;
            text-wrap: initial;
            font-size: 14px;
            font-family: sans-serif;
        }
        .buttonok{
            width: 70px;
            height: 10px;
        }
    </style>
    <head>
        <meta charset="UTF-8">
        <title>Modifica</title>
    </head>
    <body>
        <?php
            require("config.php");
            

            $select_for_modify_query = "SELECT * FROM questions WHERE q_id=" . $_POST['id'];

            $db_select_query = mysqli_query($db, $select_for_modify_query);

            if($db_select_query)
            {
                $question_row_modify = mysqli_fetch_array($db_select_query);

                if(isset($_POST['change']))
                {
                    echo "<center><br>MODIFICA<br><form action=\"confirm.php\" method=\"post\">" .
                            "<br>TITOLO<br><textarea class=\"textTitle\" name=\"title\" >".
                            $question_row_modify["q_title"] ."</textarea>" . 
                            "<br>TESTO<br><textarea name=\"text\" placeholder=\"" .
                            $question_row_modify["q_text"] . "\"></textarea>" .
                            "<input type=\"hidden\" name=\"q_id\" value=\"" .$_POST['id']."\" />" .
                            "<br><input class=\"buttonok\" type=\"submit\" name=\"confirm\" value=\"Modifica\"/></form></center>";
                }
                else if(isset($_POST['canc']))
                {
                    echo "<center><br><b>Sei sicuro di voler eliminare?</b><br>" .
                            "<form action=\"confirm.php\" name=\"choose\" method=\"post\">".
                            "<br><input type=\"submit\" value=\"si\" name=\"qDelete\"/>" .
                            "<input type=\"submit\" value=\"no\" name=\"qSave\"/></form></center>" ;
                }
            }
            else
                die("Error");

            
            
        ?>
    </body>
</html>
