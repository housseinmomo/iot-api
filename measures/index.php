<?php


header("Content-Type: application/json ");

// Connextion DB

try{
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=api;charset=utf8" , "root" , "");
    echo "Connect <br>";
    $retour["succes"] = true ;
    $retour["message"] = "Connexion a la base de donnees reussie";
} catch(Exception $e){
    $retour["succes"] = false ;
    $retour["message"] = "Connexion a la base de donnees echouer";
}

// try{
//     $sql = 'SELECT * FROM mean';
//     $requete = $pdo->query($sql);
//     $result = $requete->fetchAll();
//     echo "requete ok";
// } catch(Exception $e){
//     echo($e);
// }




if( !empty($_GET["id"]) ){
    
    $id = $_GET["id"];
    $sql = "SELECT * FROM mean WHERE value = ?";

    $sth = $pdo->prepare('SELECT * FROM mean WHERE value = ? ');
    $sth->execute(array($id));


    $result = $sth->fetchAll();

}else{
    $requete = $pdo->query("SELECT * FROM mean ");
    $requete->execute();
    $result = $requete->fetchAll();
}







$retour["succes"] = true ;
$retour["message"] = "Liste des Tests";
$retour["result"]["nombre"] = count($result);
$retour["result"]['test'] = $result;




echo json_encode($retour);