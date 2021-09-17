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

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
	<link rel="stylesheet" href="css/stylesheet2.css" />
	<title>RImmobilier l'immobilier pour tous</title>


</head>

<body class="w-100">
	<nav class="navbar bg-dark text-white navbar-light w-100">
		<div id="top">
			<h1 class="navbar-brand text-danger h-5"><a class="nav-link brand" href="index.php">RImmobilier</a></h1>
			<div id="connect">
				<?php

				if(isset($_SESSION['employe']))
				{
					if($_SESSION['employe'] == true)
					{
						echo '<a href="ressource/conseiller.php" class="btn btn-outline-danger mr-4">Espace conseiller</a>';
					}

					elseif($_SESSION['employe'] == false)
					{
						echo '<a href="" class="btn btn-outline-danger mr-4">Espace client</a>';
					}
				}

				if(isset($_SESSION['user']))
				{
					echo 'Bienvenue '.$_SESSION['prenom'];
					echo '<br /> <a href="ressource/deconnect.php" class="btn btn-outline-danger ml-4">Deconnexion</a>';
				}

				else
				{
					echo '<button class="btn btn-outline-danger mr-2" data-toggle="modal" data-target="#pop">Connectez-vous</button><br /><button class="btn btn-danger mr-2" data-toggle="modal" data-target="#inscription">Inscrivez-vous</button>';
				}



				?>
				<div class="modal" id="pop">
					<div class="modal-dialog modal-dialog-lg modal-dialog-centred">
						<div class="modal-content">
							<div class="modal-header bg-dark text-white">
								<h5 class="modal-title">Connexion</h5>
								<button class="close text-white" data-dismiss="modal"> &times; </button>
							</div>
							<div class="modal-body">
								<form method="POST" action="ressource/connect.php">
									<small class="form-text text-muted">Identifiant, adresse mail, pseudo</small>
									<input type="text" id="username" name="username" placeholder="Identifiant" class="form-control mb-2" required />
									<input type="password" id="mdp" name="mdp" placeholder="Mot de passe" class="form-control" required />
									
							</div>
							<div class="modal-footer">
									<button type="submit" class="btn btn-danger btn-block">Connexion</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="modal" id="inscription">
					<div class="modal-dialog modal-dialog-lg modal-dialog-centred">
						<div class="modal-content">
							<div class="modal-header bg-dark text-white">
								<h5 class="modal-title">Inscription</h5>
								<button class="close text-white" data-dismiss="modal"> &times; </button>
							</div>
							<div class="modal-body">
								<form method="POST" action="ressource/inscription.php">
									<small class="form-text text-muted">Nom</small>
									<input type="text" id="nomUser" name="nomUser" placeholder="Nom" class="form-control mb-2" required />
									<small class="form-text text-muted">Prénom</small>
									<input type="text" id="prenomUser" name="prenomUser" placeholder="Prénom" class="form-control mb-2" required />
									<small class="form-text text-muted">Adresse mail</small>
									<input type="email" id="emailUser" name="emailUser" placeholder="Adresse mail" class="form-control mb-2" required />
							</div>

							<div class="modal-footer">

								<button type="submit" class="btn btn-danger btn-block">S'inscrire</button>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<ul class="nav row">
			<a href="index.php" class="nav-link col-xl"><li class="nav-item active">A propos</li></a>
			<a class="nav-link col-xl" href="#"><li class="nav-item">Acheter</li></a>
			<a class="nav-link col-xl" href="#"><li class="nav-item">Louer</li></a>
			<a class="nav-link col-xl" href="#"><li class="nav-item">Vendre</li></a>
			<a class="nav-link col-xl" href="#"><li class="nav-item">Prendre rendez-vous</li></a>
		</ul>

	</nav>
	<header class="mx-auto text-centred">
		<h1 class="mx-auto text-centred"><span class="brand">RImmobilier</span> l'immobilier pour tous</h1>


		<form method="post" action="index.php">
			<div id="formBloc">
				<input type="text" name="search" id="search" placeholder="ville rechercher" onkeyup="findsearch()" autocomplete="off" class="form-control-lg form-control" />
				<div id="proposition"></div>
			</div>
			<button type="submit" id="submit" class="btn btn-danger" >RECHERCHER</button>
		</form>
	</header>

	<div id="content" class="text-centred mx-auto">
		<?php
		if(isset($_GET['to']))
			{	
				if($_GET['to'] == 1)
				{
					include('ressource/connect.php');
				}

				elseif($_GET['to'] == 2)
				{
					include('');
				}
			}

		?>

		<div id="presentation" class="mx-auto text-centred pt-3">
			<p class="mx-auto text-centred w-50">
				<span>B</span>ienvenue chez RImmobilier, le professionnel de l'immobilier pour tous, que vous cherchiez à louer, acheter, vendre ou mettre en location un bien vous êtes au bon endroit. <br /><br />
				Nos conseiller fort de plusieur années d'experience sauront au mieux vous conseiller et vous aider dans votre projet. <br /><br />

				RImmobilier présent sur le marché depuis plus de 20 ans, avec déjà plus d'1 million de personne concquise par notre expertise, avons décider de revoir nos fondement du sol au plafond afin de convenir à tous, que vous soyez un étudiant, une famille nombreuse, un rentier, RImmobilier saura être votre fer de lance. 
			</p>
		</div>
	</div>

	<footer class="bg-light text-muted mt-5 p-3 text-center border-top">
			2020 | Ricci Brandon
	</footer>

	<script type="text/javascript" src="script/function.js">
	</script>
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

   	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

   	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>