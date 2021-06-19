<?php

try{
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=api;charset=utf8" , "root" , "");
    $retour["succes"] = true ;
    $retour["message"] = "Connexion a la base de donnees reussie";
} catch(Exception $e){
    $retour["succes"] = false ;
    $retour["message"] = "Connexion a la base de donnees echouer";
}

echo json_encode($retour);