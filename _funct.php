<?php
include_once '../wp-config.php';

// ** MySQL settings - You can get this info from your web host ** //
/* The name of the database for WordPress 
define('DB_NAME', 'db13267243-lekker');

/** MySQL database username 
define('DB_USER', 'db13267243-lk');

/** MySQL database password 
define('DB_PASSWORD', '62726.Mas.1982');

/** MySQL hostname 
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. 
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. 
define('DB_COLLATE', ''); 


 Datenbank heist: 
    altmenu -> id, menu, date, kate, mydate
    daily -> id, menu, preis, suppe
 */



try {
    $conn = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME."", DB_USER, DB_PASSWORD);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully <br><br>"; 
    }
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

## Neues Menü im Archiv Speichern. ##
function newAltMenu($text, $conn, $choose){
        $time = date("Y-m-d H:i:s");
        $ins = "insert into altmenu (id, menu, date, kate) Values ('','".$text."','".$time."','".$choose."')";
        $conn->exec($ins);
}


    
/*
## SELECT abfrage für Archiv ##
*,
DATE_FORMAT(date, '%e. %m. %Y - %T') mydate
FROM
altmenu */
function getData($conn, $sort) {
    switch (true){
        case ($sort > 0):
            $sql = "SELECT *, CONVERT(menu USING utf8), DATE_FORMAT(date, '%e.%m. %Y') mydate FROM altmenu Where kate ='".$sort."' Order by id DESC";
            break;
        default :
            $sql = "SELECT *, DATE_FORMAT(date, '%e.%m. %Y') mydate FROM altmenu Order by id DESC";
            break;
    }

        $data = $conn->prepare($sql);
        $data->execute();
        return $data;
}

## Delete Daten vom Archiv ##
function delData($id, $conn) {
    $sql = "Delete From altmenu Where id='".$id."'";
    $conn->exec($sql);
}
    
function setChoose() {
    echo ''
    . '<select class = "archiv-box choose" name="choose">'
    . '<option value="1">Menü Alt</option>'
    . '<option value="2">Salate</option>'
    . '</select>'
    . '  <br>';     
}
#################
## ARCHIV ENDE ##
#################

## Eintrag Daily Menü ##
function setDailyMenu($conn, $menu, $preis, $suppe, $tag){
    //UPDATE daily SET menu = 'text', preis = '44', suppe = 'karotte' WHERE id = '1'
    $ins = "UPDATE daily SET menu = '".$menu."', preis = '".$preis."', suppe = '".$suppe."', tag = '".$tag."' WHERE id = '1'";
    $conn->exec($ins);
}

function getDailyMenu($conn){
    $sql = "SELECT * FROM daily";
    $data = $conn->prepare($sql);
    $data->execute();
    return $data;
}


## Algemeine Funktionen ##

function checkTag($day, $dbDay){
    if($day === $dbDay){
        echo "selected";
    }
}