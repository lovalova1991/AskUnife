<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <style>
            table{
                width: 85%;
                border-collapse: collapse;
            }
            .categories
            {
                width: 30%;
            }
        </style>
        <meta charset="UTF-8">
        <title>Pannello Amministrazione-AskUnife</title>
    </head>
    <center>
    <body>
        <?php
            require("config.php");
            require("services.php");

            $admin_users_query = "SELECT * FROM utenti";
            $admin_question_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.id_cat = categories.id_cat ORDER BY questions.TIME";
            $admin_answers_query = "SELECT * FROM q_answers";
            $admin_categories_query = "SELECT * FROM categories";

            $db_users = mysqli_query($db, $admin_users_query);
            $db_admin_questions = mysqli_query($db, $admin_question_query);
            $db_admin_answers = mysqli_query($db, $admin_answers_query);
            $db_admin_categories = mysqli_query($db, $admin_categories_query);
            
            if($db_users)
            {
                echo    "<table border='1'>
                        <tr>
                        <b>Utenti</b>
                        <th>Email</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Password</th>
                        <th>Nascita</th>
                        <th>Azione</th>
                        </tr>";

                while($users_row = mysqli_fetch_array($db_users))
                {
                    createUserTable($users_row['email'], $users_row['nome'], $users_row['cognome'], $users_row['password'], $users_row['birth']);
                }

                if($db_admin_questions)
                {
                    echo    "<table border='1'>
                            <tr>
                            <br><br><b>Domande</b>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Titolo</th>
                            <th>Testo</th>
                            <th>Time</th>
                            <th>Utente</th>
                            <th>Azione</th>
                            </tr>";

                    while($questions_admin_row = mysqli_fetch_array($db_admin_questions))
                    {
                        createQuestionsTable("admin", $questions_admin_row['q_title'], $questions_admin_row['nome_cat'], $questions_admin_row['q_text'], $questions_admin_row['q_utente'], $questions_admin_row['q_id'], $questions_admin_row['TIME']);
                    }
                    echo "</table>";
                }
                
                if($db_admin_answers)
                {
                    echo    "<table border='1'>
                            <tr>
                            <br><br><b>Risposte</b>
                            <th>ID</th>
                            <th>a_ID</th>
                            <th>Titolo</th>
                            <th>Testo</th>
                            <th>Time</th>
                            <th>Utente</th>
                            <th>Azione</th>
                            </tr>";
                    
                    while($answer_admin_row = mysqli_fetch_array($db_admin_answers))
                    {
                        createAnswersTable($answer_admin_row["id"], $answer_admin_row["a_title"], $answer_admin_row["a_text"], $answer_admin_row["a_utente"], $answer_admin_row["time"], $answer_admin_row["a_id"]);
                    }
                    echo "</table>";
                }
                if($db_admin_categories)
                {
                    echo "<table border='1' class=\"categories\">"
                    . "<tr>"
                            . "<br><br><b>Categorie</b>"
                            . "<th>ID</th>"
                            . "<th>Nome</th>"
                            . "<th>Azione</th></tr>";
                    while($admin_categories_query = mysqli_fetch_array($db_admin_categories))
                    {
                        $id = $admin_categories_query['id_cat'];
                        
                           echo "<tr><td><center>" . $admin_categories_query["id_cat"] . "</center></td>" .
                                "<td><center>" . $admin_categories_query["nome_cat"] . "</center></td>"
                                   . "<td><center><form action=\"confirm.php\" method=\"post\">"
                                   . "<input type=\"submit\" name=\"catDelete\" value=\"Elimina\" />"
                                   . "<input type=\"hidden\" name=\"catId\" value='" . $id . "'/></form></center>" .
                                "</tr>" ;
                    }
                    echo "</table>";
                }
                echo "<form action=\"confirm.php\" method=\"post\">"
                . "Nuova Categoria..  <input type=\"text\" name=\"nameofcategory\"/>"
                        . "<input type=\"submit\" name=\"newCategoryadmin\"/>"
                        . "</form>";
            }
            
        ?>
        <br><br>
        <form action="confirm.php" method="post">
            <input type='submit' value="Logout" name="logout"/>
        </form>
    </body>
    </center>
</html>
