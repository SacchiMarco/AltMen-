<?php
session_start();
include_once "_safety.php";
include '../AlteMenus/_funct.php';
$message = "";

if(isset($_GET["send"])){
    $text = $_POST["text"];
    $choose = $_POST["choose"];
    
    if(!empty($text)){
        newAltMenu($text, $conn, $choose);
        $message = "Menü eingetragen. ";
    }
    else {
        $send = false;
        $message= "LEERES FELD NICHT ERLAUBT";
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Alte Menüs</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/css.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
        <link rel="shortcut icon" type="image/x-icon" href="http://lekker-lekker.ch/wp-content/uploads/2018/02/cropped-ms-icon-310x310.png"> 
    </head>
    <body>
        <?php
        include 'navi.html';
        echo"<div>".$message." </div>"
        ?>
        <br>
        <div class="titel">Menü eintragen:</div>
        <br>
        <div>
            <form action="index.php?send=1" method="post">
                <?php setChoose() ?>
                <textarea class = "archiv-box" name="text" style="width:200px; height:200px;"></textarea>
                <br>
                <input class = "archiv-box submit" type="submit" value="Speichern">
            
            </form>
        </div>
    </body>
</html>
<?php
$conn->close();
