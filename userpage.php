<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifica utente</title>
    </head>
    <body>
        <?php
        require("config.php");
        require ("services.php");

        $user = $_SESSION["user"];

        $user_query = "SELECT * FROM utenti WHERE email='" . $user ."'";

        $db_user_query = mysqli_query($db, $user_query);

        $db_user_row = mysqli_fetch_array($db_user_query);

        if($db_user_query)
        {
            //form modifica utente
            createModifyUserForm("user", $db_user_row["nome"], $db_user_row["cognome"], $db_user_row["email"], $db_user_row["password"], $db_user_row["birth"]);

            //form elimina utente
            echo    "<center><br><b>ELIMINA UTENTE</b><br>" .
                    "<form action=\"confirm.php\" name=\"canc\" method=\"post\"> " .
                    "<input type=\"submit\" name=\"deleteuser\" value=\"Elimina utente\"/>" .
                    "</form></center>";
        }
        else
        {
            die("Something wrong");
        }

        ?>
    </body>
</html>
