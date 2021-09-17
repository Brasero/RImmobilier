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


		if(isset($_GET['search']))
			{			
				$recherche = $_GET['search'];
				$i = 0; 

				$query = $bdd->query('SELECT * FROM ville INNER JOIN bien ON bien.ID_ville_bien = ville.ID INNER JOIN departement ON ville.ID_departement = departement.ID INNER JOIN cave ON bien.ID_cave = cave.ID INNER JOIN garage ON bien.ID_garage = garage.ID INNER JOIN grenier ON bien.ID_grenier = grenier.ID INNER JOIN parking ON bien.ID_parking = parking.ID INNER JOIN conseiller ON bien.ID_conseiller_bien = conseiller.ID INNER JOIN proprietaire ON bien.ID_proprietaire = proprietaire.ID INNER JOIN cuisine ON bien.ID_cuisine = cuisine.ID INNER JOIN photo ON photo.ID_bien = bien.ID WHERE ville.nom LIKE "'.$recherche.'%" GROUP BY bien.ID');

				$respond = $query->fetch();


				while($respond != null)
				{
					$i++;
					if($i%2 == 0)
						{	
							echo '<div class="paire mt-4 text-centred mx-auto card" style="width: 50rem;" id="'.$respond[5].'" onclick="addMore(\''.$respond[5].'\')">';
						}

					else
						{	
							echo '<div class="impaire mt-4 text-centred mx-auto card" style="width: 50rem;" id="'.$respond[5].'" onclick="addMore(\''.$respond[5].'\')">';
						}

					if($respond['transaction'] == 0)
						{	
							$transaction = 'A vendre';
							$type = '€';
						}

					elseif($respond['transaction'] == 1)
						{	
							$transaction = 'A louer';
							$type = '€/mois';
						}

					echo '<div id="img" class="text-centred mx-auto mr-3 card-img" style="background: url('.$respond['url'].'); background-size: cover; background-position: center; min-width: 300px; min-height: 200px"></div>';
					echo '<div class="card-img-overlay" style="display: flex; flex-direction: column; width: -webkit-fill-available; background: rgba(215,215,215,0.4);"><div style="margin-top: 5px; margin-left: 5px;">';
					echo '<span class="type text-danger">'.$transaction.', '.$respond['type_bien'].'</span>,<br /> '.$respond['prix'].' '.$type.' </div><br /><div style="margin-top: auto; width: -webkit-fill-available;">';

					echo '<div class="searchInfo ml-2">
							<div class="surface mr-1">
								<div class="ico-surface mr-1">
								</div>
								<div class="mesure-surface mr-1">
								</div>'
									.$respond['surface_habitable'].'m²
								</div>
								<div class="piece mr-1">
								<div class="ico-piece mr-1">
								</div>
								<div class="nbPiece mr-1">'
									.$respond['nb_piece'].'p.
								</div>
							</div>
							<div class="chambre mr-1">
								<div class="ico-chambre mr-1">
								</div>
								<div class="nbchambre mr-1">'
									.$respond['nb_chambre'].' chambre
								</div>
							</div>
						</div>
						<div class="localite ml-1">
							'.$respond[1].'
						</div>
					</div>
						<div class="plusInfo btn btn-lg btn-outline-danger align-self-end">
							Voir plus
						</div>
					<br />';
					echo '</div>';

					echo '</div>';
					$respond = $query->fetch();
				}	
			}
	?>