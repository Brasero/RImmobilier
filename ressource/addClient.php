<?php
session_start();

try
{
	$bdd = new PDO('mysql:host=localhost; dbname=immobilier; charset=utf8', 'root', '');
}

catch(PDOException $fail)
{
    print 'Erreur : '.$fail->getMessage();
    die();
}


if(isset($_POST['nom']))
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];
        $num = $_POST['num'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $identifiant = time();
        $identifiant = 1203154612;

        $num = trim($num, '+33');

        $villeQuery = $bdd->query('SELECT * FROM ville WHERE nom ="'.$ville.'"');

        $villeInfo = $villeQuery->fetch();

        $inserQuery = $bdd->prepare("INSERT INTO proprietaire (nom_proprio, prenom_proprio, mail_proprio, num_proprio, adresse_proprio, ID_ville_proprio, ID_conseiller_proprio) VALUES (:nom, :prenom, :mail, :num, :adresse, :idVille, :idConseiller)");

        $inserQuery->bindParam(':nom', $nom, PDO::PARAM_STR);
        $inserQuery->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $inserQuery->bindParam(':mail', $mail, PDO::PARAM_STR);
        $inserQuery->bindParam(':num', $num, PDO::PARAM_INT);
        $inserQuery->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $inserQuery->bindParam(':idVille', $villeInfo['ID'], PDO::PARAM_INT);
        $inserQuery->bindParam(':idConseiller', $_SESSION['ID_conseiller'], PDO::PARAM_INT);

        $inserQuery->execute() or die(print_r($inserQuery->errorInfo()));


        header('Location: conseiller.php?menu=2');
    }

?>