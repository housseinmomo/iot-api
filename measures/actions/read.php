<?php
include "..\\Class\\Measure.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require "../includes/db_connexion.php";

 spl_autoload_register(function ($class_name) {
    include "..\\Class\\".$class_name . '.php';
});

$p = new Measure($pdo);

$result = $p->read();

$count = $result->rowCount();

if($count > 0){
    $post_arr = array();
    $post_arr["data"] =array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_items = array(
            "id" => $id ,
            "value" => $value,
            "read" => $read ,
            "fired" => $fired,
        );

        array_push($post_arr["data"] , $post_items);
    }

    echo json_encode($post_arr);
}else{
    echo json_encode(array("Message" => "No Post Found"));
}

