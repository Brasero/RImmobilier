<?php

session_start();

try
    {
        $bdd = new PDO('mysql:host=localhost:3306; dbname=dcm8_; charset=utf8', 'dcm8', 'R*v7cx82');
    }

catch(PDOException $e)
    {
        print 'Erreur : '.$e->getMessage();
        die;
    }

    var_dump($_POST);

if(isset($_POST['client_ID']))
    {
        $id = $_POST['client_ID'];
    }

if(isset($_POST['clientName']))
    {
        $name = $_POST['clientName'];

        $nameQuery = $bdd->prepare('UPDATE proprietaire SET nom_proprio =:name WHERE ID ='.$id.'');

        $nameQuery->bindValue(':name', $name, PDO::PARAM_STR);

        $nameQuery->execute();
    }

if(isset($_POST['clientPrenom']))
    {
        $prenom = $_POST['clientPrenom'];

        $prenomQuery = $bdd->prepare('UPDATE proprietaire SET prenom_proprio =:prenom WHERE ID ='.$id.'');

        $prenomQuery->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $prenomQuery->execute();
    }

if(isset($_POST['mail_proprio']))
    {
        $mail = $_POST['mail_proprio'];

        $mailQuery = $bdd->prepare('UPDATE proprietaire SET mail_proprio =:mail WHERE ID ='.$id.'');

        $mailQuery->bindValue(':mail', $mail, PDO::PARAM_STR);
        $mailQuery->execute();
    }

if(isset($POST['num_proprio']))
    {
        $num = $_POST['num_proprio'];
        $num = trim($num, '+33');

        $numQuery = $bdd->prepare('UPDATE proprietaire SET num_proprio =:num WHERE ID ='.$id.'');

        $numQuery->bindValue(':num', $num, PDO::PARAM_STR);
        $numQuery->execute();
    }

if(isset($_POST['adresse_proprio']))
    {
        $adresse = $_POST['adresse_proprio'];

        $adresseQuery = $bdd->prepare('UPDATE proprietaire SET adresse_proprio =:adresse WHERE ID ='.$id.'');

        $adresseQuery->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $adresseQuery->execute();
    }

if(isset($_POST['ville_proprio']))
    {
        $villeName = $_POST['ville_proprio'];

        $villeRecherche = $bdd->query('SELECT * FROM ville WHERE nom = "'.$villeName.'"');

        $ville = $villeRecherche->fetch();

        $modifyClientVille = $bdd->query('UPDATE proprietaire SET ID_ville_proprio ='.$ville['ID'].' WHERE ID ='.$id.'');
    }

    header('Location: conseiller.php?menu=2');
?>
