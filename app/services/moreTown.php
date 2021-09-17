<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../config/database.php");

$bdd = new Database;

$bdd->getConnexion();

$data = json_decode(file_get_contents("php://input"));

$queryStr = 'SELECT * FROM ville 
            INNER JOIN bien 
            ON bien.ID_ville_bien = ville.ID 
            INNER JOIN departement 
            ON ville.ID_departement = departement.ID 
            INNER JOIN cave 
            ON bien.ID_cave = cave.ID 
            INNER JOIN garage 
            ON bien.ID_garage = garage.ID 
            INNER JOIN grenier 
            ON bien.ID_grenier = grenier.ID 
            INNER JOIN parking 
            ON bien.ID_parking = parking.ID 
            INNER JOIN conseiller 
            ON bien.ID_conseiller_bien = conseiller.ID 
            INNER JOIN proprietaire 
            ON bien.ID_proprietaire = proprietaire.ID 
            INNER JOIN cuisine 
            ON bien.ID_cuisine = cuisine.ID 
            INNER JOIN photo 
            ON photo.ID_bien = bien.ID 
            WHERE ville.ID = "'.$data.'" GROUP BY bien.ID';

$query = $bdd->connexion->query($queryStr);

$reponse = $query->fetchAll();

echo json_encode($reponse);

?>