<?php
session_start();

$db_name = "AskUnife";
$db_password = "";
$db_host = "localhost";
$db_user = "root";

$db = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if(!$db)
{
    die ("database non connesso.");
}

