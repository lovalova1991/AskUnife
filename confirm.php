<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Confermato!</title>
    </head>
    <body>
        <?php
            require ("config.php");
            require ("services.php");
            
            
            //GESTIONE ADMIN
            if(isset($_POST["admin_modifyQ"]))
            {
                $admin_q_modify_query = "SELECT questions.*, categories.* FROM questions JOIN categories WHERE q_id='" . $_POST["q_id"] . "'";
                $db_admin_q_modify = mysqli_query($db, $admin_q_modify_query);
                $admin_q_row = mysqli_fetch_array($db_admin_q_modify);
                
                $_SESSION["mod"] = $_POST["q_id"];
                
                echo        "<br>Modifica Domanda<br><form action=\"confirm.php\" method=\"post\">" .
                            "<br>Titolo<br><input type=\"text\" name=\"title\" value=\"" .
                            $admin_q_row["q_title"] . "\" />" . 
                            "<br>Testo<br><input type=\"text\" name=\"text\" value=\"" .
                            $admin_q_row["q_text"] . "\" />" .
                            "<br>Categoria<br><input type=\"text\" name=\"category\" value=\"" .
                            $admin_q_row["nome_cat"] . "\" />" .
                            "<input type=\"hidden\" name=\"q_id\" value=\"" . $_POST["q_id"] . "\"/>" .
                            "<br><input type=\"submit\" name=\"confirm\" value=\"Modifica\"/></form>";
            }
            
            if(isset($_POST["admin_deleteQ"]))
            {
                $delete_query = "DELETE FROM questions WHERE q_id=" . $_POST["q_id"];
                $db_admin_delete_question = mysqli_query($db, $delete_query);
                if($db_admin_delete_question)
                {
                    echo "Domanda cancellata con successo";
                    header("refresh:1;url=adminpanel.php");
                }
                else
                {
                    echo "Errore nella cancellazione della domanda";
                }
                unset($_POST["admin_deleteQ"]);
            }
            
            if(isset($_POST["adminDelete"]))
            {
                $delete_user_admin = "DELETE FROM utenti WHERE email='" . $_POST["u_mail"] ."'";
                $db_admin_delete_user = mysqli_query($db, $delete_user_admin);
                if($db_admin_delete_user)
                {
                    echo "Utente cancellato con successo";
                    header("refresh:1;url=adminpanel.php");
                }
                else 
                {
                    echo "Errore nella cancellazione dell'utente.";
                }
                unset($_POST["adminDelete"]);
            }
            
            if(isset($_POST["adminModify"]))
            {
                $admin_modify_query = "SELECT * FROM utenti WHERE email='" . $_POST["u_mail"]. "'";
                $db_admin_modify = mysqli_query($db, $admin_modify_query);
                
                $modify_row = mysqli_fetch_array($db_admin_modify);
                
                createModifyUserForm("admin",$modify_row["nome"], $modify_row["cognome"], $modify_row["email"], $modify_row["password"], $modify_row["birth"]);
                unset($_POST["adminModify"]);
            }
            
            if(isset($_POST["adminMod"]))
            {
                $admin_user_mod_query = "UPDATE utenti SET email='" . $_POST["mail"] .  "', nome='" . $_POST["nome"] .  "', cognome='" . $_POST["cognome"] .  "' ,password='" . $_POST["pass"] .  "', birth='" . $_POST["data"] .  "' WHERE email='" . $_POST["hiddenAdmin"] . "'";
                
                $db_mod_admin = mysqli_query($db, $admin_user_mod_query);
                
                if($db_mod_admin)
                {
                    echo "<br><center>Modifiche effettuate</center>";
                    unset($_POST["adminMod"]);
                    header("refresh:1;url=adminpanel.php");
                }
                else
                {
                    echo "Errore, modifiche non effettuate.";
                    unset($_POST["adminMod"]);
                }
            }
            
            if(isset($_POST["nominateAdmin"]))
            {
                $change_mode_query = "SELECT * FROM utenti where email='" . $_POST["u_mail"] ."'";
                
                $db_query_user = mysqli_query($db, $change_mode_query);
                
                if($db_query_user)
                {
                    $user_change_row = mysqli_fetch_array($db_query_user);
                    
                    $change_toAdmin_query = "INSERT INTO admin (email, nome, cognome, password) VALUES ('". $user_change_row["email"]. "','". $user_change_row["nome"]. "','". $user_change_row["cognome"]. "','". $user_change_row["password"]. "')";
                    
                    $db_insert_new_admin = mysqli_query($db, $change_toAdmin_query);
                    
                    if($db_insert_new_admin)
                    {
                        $db_cancel_query = "DELETE FROM utenti WHERE email='". $_POST["u_mail"] . "'";
                    
                        $db_cancel_user = mysqli_query($db, $db_cancel_query);
                    
                        if($db_cancel_user)
                        {
                            echo "Tutto ok!";
                            header("refresh:2;url=adminpanel.php");
                        }
                    }
                }
            }
            
            //GESTIONE LOGIN
            //Registrazione
            if(isset($_POST["goregister"]))
            {
                $u_name = $_POST["name"];
                $u_surname = $_POST["surname"];
                $u_pass = $_POST["password"];
                $u_mail = $_POST["email"];
                $u_birth = $_POST["birth"];

                $query_control_user = "SELECT * FROM utenti WHERE email='$u_mail'";

                $db_control_user = mysqli_query($db, $query_control_user);

                $row = mysqli_fetch_array($db_control_user);

                $num_row = mysqli_num_rows($db_control_user);

                if($num_row > 0)
                {
                    echo ("<br><center>Sei registrato come " . $u_mail . " Usa il pannello di login.</center>");
                    unset($_POST["goregister"]);
                    header("refresh:2; url=index.php");
                }

               //controllo che i campi siano riempiti
                if($u_name == "" || $u_surname == "" || $u_pass == "" || $u_mail == "" || $u_birth == "")
                {
                    echo "<center><b>Attenzione!</b>Non hai inserito correttamente tutti i campi! Verrai reindirizzato alla pagina precedente.</center>";
                    unset($_POST["goregister"]);
                    header("refresh:2; url=index.php");
                }
                else
                {
                    $query_insert_user = "INSERT INTO utenti (email, nome, cognome, password, birth) VALUES ('$u_mail', '$u_name', '$u_surname', '$u_pass', '$u_birth')";

                    $db_insert_user = mysqli_query($db, $query_insert_user);

                    if($db_insert_user)
                    {
                        echo "<br><center>Sei registrato con successo " . $u_name ."</center>" ;
                        $_SESSION["user"] = $u_mail;
                        $_SESSION["isAdmin"] = "NO";
                        header("refresh:2;url=home.php");
                    }
                    else 
                    {
                        die ("<center><br>La registrazione non è andata a buon fine, riprova. </center>");
                        header("refresh:2; url=index.php");
                    }
                }
            }
            
            //login di un utente
            if(isset($_POST["gologin"]))
            {
                $log_mail = $_POST["log_email"];
                $log_passw = $_POST["log_psw"];

                if($log_mail == "" || $log_passw == "")
                {
                    echo "<br><center>Non hai inserito tutti i parametri di login. Riprova.</center>";
                    header("refresh:2; url=index.php");
                }
                else 
                {
                    $log_query = "SELECT * FROM utenti WHERE email='$log_mail' AND password='$log_passw'";

                    $db_log = mysqli_query($db, $log_query);

                    $log_row = mysqli_fetch_array($db_log);

                    if($log_row['email'] == "" || $log_row['password'] == "")
                    {
                        echo "<br><center>Nome utente o password non corretti.<br> Riprova.</center>";
                        header("refresh:2; url=index.php");
                    }
                    else 
                    {
                        echo ("<br><center>Benvenuto " . $log_row['nome'] . "!</center>");
                        $_SESSION["user"] = $log_row['email'];
                        $_SESSION["isAdmin"] = "NO";
                        header("refresh:2;url=home.php");
                    }
                }
            }
            
            //login di admin
            if(isset($_POST["goadmin"]))
            {
                $admin_mail = $_POST["admin_mail"];
                $admin_pass = $_POST["admin_psw"];
                
                if($admin_mail == "" || $admin_pass == "")
                {
                    echo "<br><center>Non hai inserito tutti i parametri, riprova.</center>";
                    header("refresh:2; url=index.php");
                }
                else
                {
                    $admin_query = "SELECT * FROM admin WHERE email='$admin_mail' AND password='$admin_pass'";

                    $db_admin = mysqli_query($db, $admin_query);

                    $admin_row = mysqli_fetch_array($db_admin);
                    if($admin_row["nome"] == "" || $admin_row["email"] == "")
                    {
                        echo "<br><center>Non sei autorizzato ad entrare.<br> Usa il pannello login o il pannello di registrazione.</center>";
                        header("refresh:2; url=index.php");
                    }
                    else
                    {
                        echo("<center><br>Sei connesso come Admin. " . $admin_mail . "</center>" );
                        $_SESSION["user"] = $admin_mail;
                        $_SESSION["isAdmin"] = "Yes";
                        header("refresh:2;url=adminpanel.php");
                    }
                }
            }
            
            //GESTIONE LOGOUT
            if(isset($_POST["logout"]))
            {
                mysqli_close($db);
                session_abort();
                echo("<center>Logout effettuato</center>");
                unset($_SESSION["user"]);
                header("refresh:1;url=index.php");
            }
            
            //GESTIONE UTENTE
            if(isset($_POST["moduser"]))
            {
                $nome = $_POST["nome"];
                $cognome = $_POST["cognome"];
                $email = $_POST["mail"];
                $pass = $_POST["pass"];
                $data = $_POST["data"];
                
                //vengono anche già aggiornate le domande e le risposte
                $user_update_query = "UPDATE utenti SET nome='" . $nome . "' , cognome='" . $cognome . "' , email='" . $email . "' , birth='" . $data . "' WHERE email='" . $_SESSION["user"] . "'";
                
                $db_update_user = mysqli_query($db, $user_update_query);
                
                if($db_update_user)
                {       
                    //se cambio email devo effettuare il login
                    echo "<br><center>Modifiche confermate</center>";
                    header("refresh:1;url=home.php");
                }
                else 
                {
                    die ("modifiche non effettuate");
                }
            }
            
            if(isset($_POST["deleteuser"]))
            {
                echo("sto cancellando...");
                //l'eliminazione dell'utente comporta anche l'eliminazione delle domande e di tutte le risposte dell'utente stesso
                $delete_user_query = "DELETE FROM utenti WHERE email='" . $_SESSION["user"] ."'";
                
                $db_delete_user = mysqli_query($db, $delete_user_query);
                
                if($db_delete_user)
                {
                    echo "Sei stato cancellato!";
                    header("refresh:2;url=index.php");
                }
                
            }
            
            //GESTIONE DOMANDE PER UTENTE
            if(isset($_POST["q_id"]))
            {
                if(isset($_POST["confirm"]))
                {
                    $text = $_POST["text"];
                    $title = $_POST["title"];

                    $update_query = "UPDATE questions SET q_title='$title', q_text='$text' WHERE q_id=" . $_POST["q_id"];
                    $db_update = mysqli_query($db, $update_query);
                    if($db_update)
                    {
                        if($_SESSION["isAdmin"] == "Yes")
                        {
                            echo "<center><br><b>Modifica effettuata con successo</b></center";
                            header("refresh:1;url=adminpanel.php");
                        }
                        else
                        {
                            echo "<br><center>Modifica effettuata con successo.</center>";
                            header("refresh:1;url=home.php");
                        }
                    }
                }
                else if(isset($_POST["qDelete"]))
                {
                    
                    $delete_query = "DELETE FROM questions WHERE q_id=" . $_SESSION["q_mod_id"];
                    
                    $db_q_delete = mysqli_query($db, $delete_query);
                    
                    if($db_q_delete)
                    {
                        echo "Domanda cancellata";
                        header("refresh:1;url=home.php");
                    }
                }
                else if(isset($_POST["qSave"]))
                {
                    echo("<br><center>La domanda non è stata cancellata.</center>ß");
                    header("refresh:1;url=home.php");
                }
                
            }
            
            
            //GESTIONE RISPOSTE
            if(isset($_POST["insert"]))
            {
                $a_title = $_POST["a_title"];
                $a_text = $_POST["a_text"];
                $a_id = $_POST["a_id"];
                $a_utente = $_SESSION["user"];
                
                $insert_a_query = "INSERT INTO q_answers (a_id, a_utente, a_title, a_text) VALUES ('$a_id','$a_utente','$a_title','$a_text')" ;
                
                $db_a_insert = mysqli_query($db, $insert_a_query);
                if($db_a_insert)
                {
                    echo("Risposta inserita con successo");
                    header("refresh:1;url=home.php");
                }
            }
            
            if(isset($_POST["newCategoryadmin"]))
            {
                if(isset($_POST["nameofcategory"]))
                {
                    $category = $_POST["nameofcategory"];
                    $insert_category_query = "INSERT INTO categories (nome_cat) VALUES ('$category')";
                    $db_insert_category = mysqli_query($db, $insert_category_query);
                    echo "Categoria inserita, aggiorna la pagina.";
                    header("refresh:1;url=adminpanel.php");
                }
                else
                {
                    echo "error!";
                    header("refresh:2;url=adminpanel.php");
                }
            }
            
            if(isset($_POST["catDelete"]))
            {
                if(isset($_POST["catId"]))
                {
                    $delete_cat_query = "DELETE FROM categories WHERE id_cat=\"" . $_POST["catId"] . "\"";
                    $db_cat_delete = mysqli_query($db, $delete_cat_query);
                    if($db_cat_delete)
                    {
                        echo "Categoria eliminata con successo!";
                        header("refresh:1;url=adminpanel.php");
                    }
                    else
                    {
                        echo "error";
                    }
                }
            }
        ?>
    </body>
</html>
