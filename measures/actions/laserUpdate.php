<?php
include "..\\Class\\Measure.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type , Access-Control-Allow-Methods ,  Authorization,");

require "../includes/db_connexion.php";

 spl_autoload_register(function ($class_name) {
    include "..\\Class\\".$class_name . '.php';
});

$p = new Measure($pdo);

// get raw posted data
$raw = utf8_encode(file_get_contents("php://input"));

$data = json_decode($raw);
echo json_last_error();

$p->id = $data->id;
$p->fired  = $data->fired;

var_dump($raw);

// Create Post
if($p->laserUpdate() && $p->fired != null && $p->id != null){
    echo json_encode(array("Message" => "Update du fired reussie"));
} else{
    echo json_encode(array("Message" => "Echec de l'update fired"));
}



