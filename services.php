<?php

    function createQuestionsTable($mode, $titolo, $categoria, $testo, $utente, $id, $tempo)
    {
        if($mode == "user")
        {
            echo    "<table class=\"table\" border='1'>
                    <tr>
                    <th>Titolo</th>
                    <th>Categoria</th>
                    <th>Testo</th>
                    <th>Utente</th>
                    </tr>
                    <tr>" .
                    "<br><td>" . $titolo . "</td>" .
                    "<td>" . $categoria . "</td>" .
                    "<td>" . $testo . "</td>" .
                    "<td>" . $utente . "</td>" .
                    "<td><form action=\"answer.php\" method=\"post\">" .
                    "<input type=\"submit\" name=\"answer\" value=\"Rispondi\"/>" .
                    "<input type=\"hidden\" name=\"q_id\" value=\"" . $id . "\"/>"
                    . "</form></td>" .
                    "</tr>"
                     ."</table>";  
        }
        if($mode == "admin")
        {
            echo    "<tr>" .
                    "<td>" . $id . "</td>" .
                    "<td>" . $categoria . "</td>" .
                    "<td>" . $titolo . "</td>" .
                    "<td>" . $testo . "</td>" .
                    "<td>" . $tempo . "</td>" .
                    "<td>" . $utente . "</td>" .
                    "<td><form action=\"confirm.php\" method=\"post\">" .
                    "<input type=\"submit\" name=\"admin_modifyQ\" value=\"Modifica\"/>" .
                    "<input type=\"submit\" name=\"admin_deleteQ\" value=\"Elimina\"/>" .
                    "<input type=\"hidden\" name=\"q_id\" value=\"" . $id . "\"/>"
                    . "</form></td>" .
                    "</tr>"; 
        }
    }
    
    function createAnswerForm($q_id, $user)
    {
        echo    "<center><br>INSERISCI RISPOSTA<br>"
                . "<form action=\"confirm.php\" method=\"post\">"
                . "<textarea name=\"a_title\" class=\"answertitle\" placeholder=\"Inserisci il titolo qui..\"></textarea><br>"
                . "<textarea name=\"a_text\" class=\"answertext\" placeholder=\"Inserisci il testo qui...\"></textarea><br>"
                . "<input type=\"submit\" name=\"insert\" value=\"inserisci risposta\" />"
                . "<input type=\"hidden\" name=\"a_id\" value=\"". $q_id."\" />"
                . "<input type=\"hidden\" name=\"a_utente\" value=\"". $user."\" />"
                . "</form></center>";
    }
    
    function createAnswersTable($id, $titolo, $testo, $utente, $tempo, $a_id)
    {    
        if($_SESSION["isAdmin"] == "Yes")
        {
            echo 
                    "<tr><td>" . $id . "</td>" .
                    "<td>" . $a_id . "</td>" .
                    "<td>" . $titolo . "</td>" .
                    "<td>" . $testo . "</td>" .
                    "<td>" . $tempo . "</td>" .
                    "<td>" . $utente . "</td>" .
                    "<td><center><form action=\"deletemodify.php\" method=\"post\"". "</td>" .
                    "<input type=\"submit\" name=\"change\" value=\"modifica\"/>" .
                    "<input type=\"hidden\" name=\"id\" value=\"" . $id . " \"/>" .
                    "<input type=\"submit\" name=\"canc\" value=\"elimina\"/>"  .
                    "</tr></center>" ;
        }
        else
        {
            echo   "<br><table border='1' class=\"AnswerTable\">
                   <tr>
                   <th class=\"title\">Titolo</th>
                   <th class=\"testo\">Testo</th>
                   <th class=\"utente\">Utente</th>
                   </tr>". 
                   "<tr><td>" . $titolo . "</td>" .
                   "<td>" . $testo . "</td>" .
                   "<td>" . $utente . "</td>" .
                   "</tr></table>" ;
        }
    }

    
    function createModifyForm($id,$titolo,$categoria,$testo)
    {
        echo    "<table class=\"table\" border='1'>
                <tr>
                <th class=\"id\" >ID Domanda</th>
                <th class=\"title\">Titolo</th>
                <th class=\"category\">Categoria</th>
                <th class=\"text\">Testo</th>
                <th class=\"buttons\"></th>
                </tr>";
        echo    "<tr>" .
                "<br><td>" . $id . "</td>" .
                "<td>" . $titolo . "</td>" .
                "<td>" . $categoria . "</td>" .
                "<td>" . $testo . "</td>" .
                "<td><form action=\"deletemodify.php\" method=\"post\"". "</td>" .
                "<input type=\"submit\" name=\"change\" value=\"modifica\"/>" .
                "<input type=\"hidden\" name=\"id\" value=\"" . $id . " \"/></form>" .
                "<td><form action=\"deletemodify.php\" method=\"post\"". "</td>" .
                "<input type=\"submit\" name=\"canc\" value=\"elimina\"/>" .
                "<input type=\"hidden\" name=\"id\" value=\"" . $id . " \"/></form>" .
                "</tr></table>";
    }
    
    function createModifyUserForm($mode, $nome, $cognome, $email, $password, $birth)
    {
        if($mode == "user")
        {
                echo    "<br><b>MODIFICA UTENTE</b><br>" .
                "<form action=\"confirm.php\" name=\"moduser\" method=\"post\"> " .
                    "<input type=\"text\" name=\"nome\" value=\"" . $nome . "\"/>" .
                    "<input type=\"text\" name=\"cognome\" value=\"" . $cognome . "\"/>" .
                    "<input type=\"text\" name=\"mail\" value=\"" . $email . "\"/>" .
                    "<input type=\"text\" name=\"pass\" value=\"" . $password . "\"/>" . 
                    "<input type=\"text\" name=\"data\" value=\"" . $birth . "\"/>" . 
                    "<input type=\"submit\" name=\"moduser\" value=\"Applica Modifiche\"/>" .
                    "<input type=\"hidden\" name=\"hiddenMod\" value='" . $email . "'/>" .
                "</form>";
        }
        elseif ($mode == "admin") 
        {
            echo    "<br><b>MODIFICA UTENTE</b><br>" .
                "<form action=\"confirm.php\" name=\"moduser\" method=\"post\"> " .
                    "<input type=\"text\" name=\"nome\" value=\"" . $nome . "\"/>" .
                    "<input type=\"text\" name=\"cognome\" value=\"" . $cognome . "\"/>" .
                    "<input type=\"text\" name=\"mail\" value=\"" . $email . "\"/>" .
                    "<input type=\"text\" name=\"pass\" value=\"" . $password . "\"/>" . 
                    "<input type=\"text\" name=\"data\" value=\"" . $birth . "\"/>" . 
                    "<input type=\"submit\" name=\"adminMod\" value=\"Applica Modifiche\"/>" .
                    "<input type=\"hidden\" name=\"hiddenAdmin\" value='" . $email . "'/>" .
                "</form>";
        }

    }
    
    function createUserTable($email, $nome, $cognome, $password, $birth)
    {
        echo    "<tr>" .
                "<td>" . $email . "</td>" .
                "<td>" . $nome . "</td>" .
                "<td>" . $cognome . "</td>" .
                "<td>" . $password . "</td>" .
                "<td>" . $birth . "</td>" .
                "<td><center><form action=\"confirm.php\" method=\"post\">" .
                "<input type=\"submit\" name=\"adminModify\" value=\"Modifica\"/>" .
                "<input type=\"submit\" name=\"adminDelete\" value=\"Elimina\"/>" .
                "<input type=\"submit\" name=\"nominateAdmin\" value=\"Nomina Admin\"/>" .
                "<input type=\"hidden\" name=\"u_mail\" value=\"" . $email . "\"/>"
                . "</form></center></td>" .
                "</tr>";
    }