<?php
//include_once '../AlteMenus/_funct.php';
include_once '../wp-config.php';


try {
    $conn = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME."", DB_USER, DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully <br><br>"; 
    }
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM daily";
$data = $conn->prepare($sql);
$data->execute();



$row = $data->fetch(PDO::FETCH_LAZY);

    echo "Dailyspecial: ".$row->tag;
    echo "<br><br>";
    echo nl2br($row->menu);
    echo "<br>";
    echo "CHF ".$row->preis;
    echo "<br>";
    echo "<br>";
    echo "Tagessuppe: <br>";
    echo $row->suppe;

                 
              