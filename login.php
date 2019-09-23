<?php
session_start();
$loginError = "Passwort eingeben:";

if(isset($_POST["pwd"]) && !empty($_POST["pwd"])){
    
    if(password_verify($_POST["pwd"],'$2y$10$F/IjoRkj/RQQO0KS1qlbxuUTfxg/eBi6hnHpuNlRJOz8QOPTw0kYG')){
        
        $_SESSION["login"] = "eingelogt";
        $loginError = $_SESSION["login"];
        header("location:index.php");
    }
    else{
        $loginError = "Passwort ist Falsch";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
        <link rel="shortcut icon" type="image/x-icon" href="http://lekker-lekker.ch/wp-content/uploads/2018/02/cropped-ms-icon-310x310.png"> 
    </head>
    <body>
        <div class="login-msg"><p><?php echo $loginError; ?></p></div>
        <div class="login-form">
            <form action="login.php" method="POST">
                <input type="password" pattern="[0-9]*" name="pwd" >
                <br>
                <br>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>
