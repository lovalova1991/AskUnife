<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <style>
                .table{
            font-family:Arial, Helvetica, sans-serif;
            color:#666;
            font-size: 16px;
            text-shadow: 1px 1px 0px #fff;
            background:  #dfede7;
            margin:20px;
            border:#ccc 1px solid;
            width: 95%;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            border-radius:3px;
            border-collapse: collapse;
            -moz-box-shadow: 0 1px 2px #d1d1d1;
            -webkit-box-shadow: 0 1px 2px #d1d1d1;
            box-shadow: 0 1px 2px #d1d1d1;
        }
        .id{
            width: 2%;
        }
        .title{
            width: 10%
        }
        .category{
            width: 5%;
        }
        .text{
            width: 70%
        }
        .buttons{
            width: 5%;
        }
    </style>
    <head>
        <meta charset="UTF-8">
        <title>Inserisci</title>
    </head>
    <body>
        <?php
            require("config.php");
            require("services.php");

            if(isset($_POST["insert"]))
            {
                $q_cat = $_POST["categoria"];
                $q_title = $_POST["titolo"];
                $q_text = $_POST["testo"];
                $q_utente = $_SESSION["user"];
                
                $id_cat_query = "SELECT id_cat FROM categories WHERE nome_cat='$q_cat'";
                
                $db_cat_search = mysqli_query($db, $id_cat_query);
                $cat_id = mysqli_fetch_array($db_cat_search);
                $categoria = $cat_id["id_cat"];
                
                $insert_q_query = "INSERT INTO questions (id_cat, q_title, q_text, q_utente) VALUES ('$categoria','$q_title','$q_text','$q_utente')";
                       
                $db_q_insert = mysqli_query($db, $insert_q_query);
                
                if($db_q_insert)
                {
                    echo("<center><br><b>Inserito correttamente.</b></center>");
                    header("refresh:1;url=home.php");
                } 
            }   

            else if(isset($_POST["modify"]))
            {
                //domande fatte da utente
                $user_questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND q_utente='". $_SESSION["user"]."'";

                $db_user_q = mysqli_query($db, $user_questions_query);  
                while($user_q_row = mysqli_fetch_array($db_user_q))
                {
                    createModifyForm($user_q_row['q_id'], $user_q_row['q_title'], $user_q_row['nome_cat'], $user_q_row['q_text']);
                }
            }

            
        ?>
    </body>
</html>
