<?php
include "..\\Class\\Measure.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require "../includes/db_connexion.php";

 spl_autoload_register(function ($class_name) {
    include "..\\Class\\".$class_name . '.php';
});

$p = new Measure($pdo);

$p->id = isset($_GET['id']) ? $_GET['id'] : die();

$p->read_single();


$tab_arr = array(
    "id" => $p->id ,
    "value" => $p->value ,
    "timestamp" => $p->timestamp ,
    "read" => $p->read ,
    "fired" => $p->fired ,
);

print_r( json_encode($tab_arr));

