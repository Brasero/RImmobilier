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

if(isset($_GET['id']))
    {
        $id = (int) $_GET['id'];
        $query = $bdd->query('DELETE FROM proprietaire WHERE ID ='.$id.'');
        header("Location: conseiller.php?menu=2");
    }

?>