<?PHP
session_start();
session_destroy(); 
$_SESSION = array();
//header("location:login.php");

if(!isset($_SESSION["login"]) or empty($_SESSION["login"])){
    header('location: ../login.php');
    exit();
}


