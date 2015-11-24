<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
    </head>
    <style>
        body{
            background-image: url("http://imageshack.com/a/img905/1294/932jbq.png");
            background-repeat: no-repeat;
            background-position: left top;
        }
        .TitleStyle{
            width: 200px;
            text-align: left;
            text-height: 20px;
            font-size: 20px;
        }
        .TextStyle{
            width: 600px;
            height: 150px;
            text-align: left;
            text-height: 20px;
            font-size: 16px;
        }
        .buttStyle{
            width: 150px;
            height: 30px;
            background: lightblue;
            border: black;
        }
        .buttModify{
            width: 120px;
            height: 20px;
            background:  lightgreen;
            border: black;
        }
        .buttUser{
            width: 120px;
            height: 20px;
            background: lightcyan;
            border: black;
        }
        .logoutButt{
            width: 120px;
            height: 20px;
            background: ivory;
            border: black;
        }
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
            background:  gainsboro;
            
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
        .testo{
            width: 50%;
        }
        .title{
            width: 7%;
        }
        .utente{
            width: 8%;
            
        }
    </style>
    <body> 
        <center><p style="position: absolute; left: 50px; top: 50px; alignment-adjust: central;">
        <form name="insertQuestion" action="insertmodify.php" method="post">
            <b>Inserisci una domanda</b><br>
            <br>Titolo<br>
            <textarea class="TitleStyle" size="30" name="titolo" placeholder="Inserisci un titolo qui..."></textarea>
            <br>Testo<br>
            <textarea class="TextStyle" name="testo" placeholder="Inserisci il testo qui..." ></textarea>
            <br>
            Categoria:
            <br><select name="categoria">
                <option value="Ingegneria">Ingegneria</option>
                <option value="Architettura">Architettura</option>
                <option value="Medicina">Medicina</option>
                <option value="Lettere">Lettere</option>
                <option value="Filosofia">Filosofia</option>
                <option value="Matematica">Matematica</option>
                <option value="Generale">Generale</option>
                <option value="Altro..">Altro..</option>
            </select>
            <br><br><input class="buttStyle" name="insert" type="submit" value="Inserisci la domanda"/>
        </form>
    </p>
</center>
    
    <div style="position:absolute; right:50px; top:10px;">
        <br><b>Gestione</b><br>
    <form name="modify" action="insertmodify.php" method="post">
            <input class="buttModify" name="modify" type="submit" value="Modifica Domande"/>
    </form>
    <form  action="userpage.php" method="post">
        <input class="buttUser" name="delete" type="submit" value="Gestione utente"/>
    </form>
    <form action="confirm.php" method="post">
        <input class="logoutButt" type="submit" name="logout" value="logout"/>
    </form>
        Ordina per:
            <form action="home.php" method="post">
            <select name="orderBy">
                <option value="Categoria">Categoria</option>
                <option value="Data">Data</option>
                <option value="Utente">Utente</option>
                <option value="Titolo">Titolo</option>
            </select>
            <input type="submit" name="goOrder" value="Vai"/>
            </form>
        Mostra solo:
        <form action="home.php" method="post">
            <select name="ViewCategory">
                <option value="Ingegneria">Ingegneria</option>
                <option value="Architettura">Architettura</option>
                <option value="Medicina">Medicina</option>
                <option value="Lettere">Lettere</option>
                <option value="Filosofia">Filosofia</option>
                <option value="Matematica">Matematica</option>
                <option value="Generale">Generale</option>
                <option value="Altro..">Altro..</option>
                <option value="Default">Default</option>
            </select>
            <input type="submit" name="goCategory" value="Vai"/>
        </form>
    </div>
    </p>
</p>
    
        <?php
        error_reporting(E_ALL ^ E_WARNING); 
        require ("config.php");
        require("services.php");
        
        $user = $_SESSION["user"];

        //tiro fuori il tipo di utente
        $logged_user_query = "SELECT * FROM utenti WHERE email='$user'";

        $db_logged = mysqli_query($db, $logged_user_query);

        $logged_row = mysqli_fetch_array($db_logged);
        
        
        if(isset($_POST["goCategory"]))
        {           
            switch ($_POST["ViewCategory"])
            {
                case "Ingegneria" :
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Ingegneria' ORDER BY questions.TIME ASC";
                    break;
                }
                
                case "Architettura":
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Architettura' ORDER BY questions.TIME ASC";
                    break;
                }
                
                case "Medicina" :
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Medicina' ORDER BY questions.TIME ASC";
                    break;
                }
                case "Lettere" :
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Lettere' ORDER BY questions.TIME ASC";
                    break;
                }
                case "Filosofia":
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Filosofia' ORDER BY questions.TIME ASC";
                    break;
                }
                case "Matematica" :
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Matematica' ORDER BY questions.TIME ASC";
                    break;
                }
                case "Generale":
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Generale' ORDER BY questions.TIME ASC";
                    break;
                }
                case "Altro.." :
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat AND categories.nome_cat='Altro..' ORDER BY questions.TIME ASC";
                    break;
                }
                case "Default" :
                {
                    $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat ORDER BY questions.TIME ASC";
                    break;
                }
                unset($_POST["goCategory"]);
            }
      
            }
            if(isset($_POST["goOrder"]))
            {
                switch($_POST["orderBy"])
                {
                    case "Categoria" :
                    {
                        $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat ORDER BY categories.name_cat ASC";
                        break;
                    }
                    case "Data" :
                    {
                        $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat ORDER BY questions.TIME ASC";
                        break;
                    }
                    case "Titolo" :
                    {
                        $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat ORDER BY questions.q_title ASC";
                        break;
                    }
                    case "Utente" : 
                    {
                        $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat ORDER BY questions.q_title ASC";
                        break;
                    }
                }
                unset($_POST["goOrder"]);
        }
        else 
            {
                $questions_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE questions.`id_cat` = categories.id_cat ORDER BY categories.nome_cat ASC";
            }

        
        $db_questions = mysqli_query($db, $questions_query);
        
        while($questions_row = mysqli_fetch_array($db_questions))
        {
            echo "<br><b>Domanda</b>";
            createQuestionsTable("user", $questions_row['q_title'], $questions_row['nome_cat'], $questions_row['q_text'], $questions_row['q_utente'],$questions_row['q_id']);

            $ans_query = "SELECT * FROM q_answers WHERE a_id='" . $questions_row['q_id'] . "' ORDER BY q_answers.time ASC";

            $db_ans = mysqli_query($db, $ans_query);

            $counter = 1;
            
            while($ans_row = mysqli_fetch_array($db_ans))
            {
                
                echo "Risposta " . $counter;
                createAnswersTable($ans_row['id'], $ans_row['a_title'], $ans_row['a_text'], $ans_row['a_utente'], $ans_row['time'], $ans_row['a_id']);
                $counter = $counter + 1;
            }
            $counter = 1;
            echo "---------------------------------------------------------------------------";
        }
        
         echo ("<footer>Sei " . $logged_row["nome"] . " " . $logged_row["cognome"]. " <br>" . $logged_row["email"] . "</footer>");
        
        
        ?>
    </body>
</html>
