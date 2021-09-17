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

$bien = $_GET['bien'];

$query = $bdd->query('SELECT * FROM bien WHERE bien.identifiant_bien = "'.$bien.'"');

$result = $query->fetch();

$picQuery = $bdd->query('SELECT * FROM photo WHERE photo.ID_bien = "'.$result['ID'].'"');

$picResult = $picQuery->fetch();

while($picResult != null)
	{	
		echo $picResult['url'].';';
		$picResult = $picQuery->fetch();
	}



?>