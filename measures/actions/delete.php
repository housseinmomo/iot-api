<?php
include "..\\Class\\Measure.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type , Access-Control-Allow-Methods ,  Authorization,");

require "../includes/db_connexion.php";

 spl_autoload_register(function ($class_name) {
    include "..\\Class\\".$class_name . '.php';
});

$p = new Measure($pdo);

// get raw posted data
$raw = utf8_encode(file_get_contents("php://input"));
$data = json_decode($raw);
$p->id = $data->id;




// Create Post
if($p->delete() && $p->id != null){
    echo json_encode(array("Message" => "Suppression OK"));
} else{
    echo json_encode(array("Message" => "Echec Suppression"));
}



