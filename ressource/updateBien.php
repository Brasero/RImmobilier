<?php

session_start();

try
{
    $bdd = new PDO('mysql:host=localhost; dbname=immobilier; charset=utf8', 'root', '');
}

catch(PDOException $e)
{
    print 'Erreur : '.$e->getMessage();
    die;
}

if(isset($_POST['id_bien']))
    {
        $id = intval($_POST['id_bien']);
    }

if(isset($_POST['type_bien']))
    {
        $queryTypeBien = $bdd->query('UPDATE bien SET type_bien ="'.strval($_POST['type_bien']).'" WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['prix']))
    {
    $queryPrix = $bdd->query('UPDATE bien SET prix ='.$_POST['prix'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['descript_modify']))
    {
        $queryDescript = $bdd->query('UPDATE bien SET description_bien ="'.$_POST['descript_modify'].'" WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['surface_modify']))
    {
        $querySurface = $bdd->query('UPDATE bien SET surface_habitable ='.$_POST['surface_modify'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['nb_piece_modify']))
    {
        $queryNbPiece = $bdd->query('UPDATE bien SET nb_piece ='.$_POST['nb_piece_modify'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['nb_chambre_modify']))
    {
        $queryNbChambre = $bdd->query('UPDATE bien SET nb_chambre ='.$_POST['nb_chambre_modify'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['nb_sdb_modify']))
    {
        $queryNbSdb = $bdd->query('UPDATE bien SET nb_sdb ='.$_POST['nb_sdb_modify'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['nb_wc_modify']))
    {
        $queryNbWc = $bdd->query('UPDATE bien SET nb_wc ='.$_POST['nb_wc_modify'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['nb_placard_modify']))
    {
        $queryNbPlacard = $bdd->query('UPDATE bien SET nb_placard ='.$_POST['nb_placard_modify'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['dpe_modify']))
    {
        $queryDpe = $bdd->query('UPDATE bien SET dpe ='.$_POST['dpe_modify'].' WHERE identifiant_bien ='.$id.'');
    }


if(isset($_POST['proprio_id']))
    {
        $queryProprioId = $bdd->query('UPDATE bien SET ID_proprietaire ='.$_POST['proprio_id'].' WHERE identifiant_bien ='.$id.'');
    }

if(isset($_POST['place_parking']) && isset($_POST['parkink_id']))
    {
        $queryGarage = $bdd->query('UPDATE parking SET nb_place_parking ='.$_POST['place_parking'].' WHERE ID ='.$_POST['parking_id'].'');
    }

header('Location: conseiller.php?menu=1');

?>