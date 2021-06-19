<?php
include "..\\Class\\Measure.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type , Access-Control-Allow-Methods ,  Authorization,");

require "../includes/db_connexion.php";

 spl_autoload_register(function ($class_name) {
    include "..\\Class\\".$class_name . '.php';
});

$p = new Measure($pdo);

// get raw posted data
$data = json_decode(file_get_contents("php://input"));

$p->value = $data->value;

// Create Post
if($p->create() && $p->value != null){
    echo json_encode(array("Message" => "Ajout reussie"));
} else{
    echo json_encode(array("Message" => "Echec de l'ajout"));
}



