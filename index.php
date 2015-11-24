<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>AskUnife</title>
    </head>
    <style>
        .regform{
            
        }
        .TextStyle{
            height: 20px;
            width: 200px;
        }
        .buttStyle{
            width: 80px;
            height: 30px;
            background: lightblue;
            border: black;
            position: absolute; bottom: -40px;
        }
        body{
            background-image: url("http://imageshack.com/a/img913/5218/E2Mzly.jpg");
            background-repeat: no-repeat;
            background-position: right top;
        }
    </style>
    <body>
        <div style="position: absolute; left: 50px; top: 50px;">
            <b>Registrazione</b>
            <form class="regform" title="Registrazione" action="confirm.php" method="post">
                Nome<br>
                <input class="TextStyle" name="name" type="text"/>
                <br>Cognome<br>
                <input class="TextStyle" name="surname" type="text"/>
                <br>Email<br>
                <input class="TextStyle" name="email" type="text"/>
                <br>Password<br>
                <input class="TextStyle" name="password" type="text"/>
                <br>Data di nascita<br>
                <input class="TextStyle" name="birth" type="date"/>
                <br><input class="buttStyle" name="goregister" value="Registrati" type="submit"/>
            </form>
        </div>
            
        </p>
        
        <div style="position:absolute; left: 300px; top: 100px">
            <br><b>Login</b>
            <form class="regform" action="confirm.php" method="post">
            Email<br>
            <input class="TextStyle" name="log_email" type="text"/>
            <br>Password<br>
            <input class="TextStyle" name="log_psw" type="text"/>
            <br><input class="buttStyle" name="gologin" type="submit" value="Entra"/>
        </form>
        </div>
        
        <div style="position:absolute; bottom: 100px; left: 50px">
            <br><br><br><br><b>Area riservata</b><br>
        <form class="regform" action="confirm.php" method="post">
            Email<br>
            <input class="TextStyle" name="admin_mail" type="text"/>
            <br>Password<br>
            <input class="TextStyle" name="admin_psw" type="text"/>
            <br><input class="buttStyle" name="goadmin" type="submit" value="Entra"/>
        </form>
        </div>
        <?php
        require 'config.php';
        ?>
    </body>
</html>
