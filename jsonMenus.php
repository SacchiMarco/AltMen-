<?php

include_once '../AlteMenus/_funct.php';
header('Content-type: text/html; charset=utf-8');
$data = getData($conn, 1);

$counter = 0;
while($row = $data->fetch(PDO::FETCH_LAZY)){
       
    $string = trim(preg_replace('/\s\s+/', ' ', $row->menu));
    $json1["Item".$counter] = array("Id" => $row->id, "Menu" => $string, "Date"=> $row->mydate);
    $counter++;
}

echo json_encode($json1, JSON_UNESCAPED_UNICODE);