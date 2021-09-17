<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../config/database.php");

$bdd = new Database;

$bdd->getConnexion();

$data = json_decode(file_get_contents("php://input"));

$queryStr = "SELECT * FROM ville WHERE ville.nom LIKE '".$data->town."%'";


/*$startQuery = $bdd->connexion->prepare($queryStr);

$startQuery->bindParam(":nom", $data->town, PDO::PARAM_STR);*/
$startQuery = $bdd->connexion->query($queryStr);
/*$startQuery->execute();*/

$response = $startQuery->fetchAll();

echo json_encode($response);

?>