<?php

if(!isset($_SESSION["login"]) or $_SESSION["login"] !== "eingelogt" ){
    session_destroy(); 
    $_SESSION = array();
    header('location: ../login.php');
    exit();
}

