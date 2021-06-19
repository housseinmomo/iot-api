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


$value = $_POST["value"] ;

if( !empty($_POST["value"] && !empty($_POST["read"]) ) ){
    
    $value = (int)$_POST["value"];
    $read = (int)$_POST['read'];

    if($read == 0 || $read == 1){

        $sth = $pdo->prepare("INSERT INTO `mean`(`value`, `read`) VALUES (? , ?)") ;
        $sth->execute(array($value , $read));
        $result = $sth->fetchAll();

        $sth2 = $pdo->query("SELECT * FROM mean");
        $sth2->execute();
        $result2 = $sth2->fetchAll();

        $retour["succes"] = true ;
        $retour["message"] = "Ajout effectuer";
        $retour["result"]["nombre"] = count($result2);
        $retour["result"]["test"] = $result2 ;
        
        echo json_encode($retour);

    } else{
        $retour["succes"] = false ;
        $retour["message"] = "Le read est soit egale 1 ou soit egale 0";
    }

}else{
    $retour["succes"] = false ;
    $retour["message"] = "Veuillez saisir toutes les informations";
}





// $retour["succes"] = true ;
// $retour["message"] = "Liste des Tests";
// $retour["result"]["nombre"] = count($result);
// $retour["result"]['test'] = $result;




