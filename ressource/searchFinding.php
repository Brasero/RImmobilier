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





$recherche = $_GET['search'];

$query = $bdd->query('SELECT * FROM ville INNER JOIN departement ON ville.ID_departement = departement.ID WHERE ville.nom LIKE "'.$recherche.'%"'); // Récupere le nom d'une ville ainsi que son CP et le departement.*

$respond = $query->fetch();

while($respond != null)
	{	
		echo '<a onclick="addResult(\''.$respond[1].'\')">'.$respond[1].' ('.$respond['nom'].')</a><br />';
		$respond = $query->fetch();

	}

?>