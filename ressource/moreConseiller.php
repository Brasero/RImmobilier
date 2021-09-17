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


		if(isset($_GET['bien']))
			{			
				$recherche = $_GET['bien'];
				$i = 0; 

				$query = $bdd->query('SELECT * FROM bien INNER JOIN ville ON bien.ID_ville_bien = ville.ID INNER JOIN departement ON ville.ID_departement = departement.ID INNER JOIN cave ON bien.ID_cave = cave.ID INNER JOIN garage ON bien.ID_garage = garage.ID INNER JOIN grenier ON bien.ID_grenier = grenier.ID INNER JOIN parking ON bien.ID_parking = parking.ID INNER JOIN conseiller ON bien.ID_conseiller_bien = conseiller.ID INNER JOIN proprietaire ON bien.ID_proprietaire = proprietaire.ID INNER JOIN cuisine ON bien.ID_cuisine = cuisine.ID INNER JOIN photo ON bien.ID = photo.ID_bien WHERE bien.identifiant_bien = "'.$recherche.'"');

				$respond = $query->fetch();

				$queryProprio = $bdd->query('SELECT * FROM ville WHERE ville.ID = '.$respond['ID_ville_proprio'].'');

				$respondProprio = $queryProprio->fetch();
				

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

						switch($respond['dpe'])
						{
							case 1:
									$dpe = 'A';
									$color = '#208346';
									break;
	
							case 2:
									$dpe = 'B';
									$color = '#32A548';
									break;
	
							case 3:
									$dpe = 'C';
									$color = '#B7CD5A';
									break;
	
							case 4:
									$dpe = 'D';
									$color = '#EFE61F';
									break;
	
							case 5:
									$dpe = 'E';
									$color = '#F2C62C';
									break;
	
							case 6:
								$dpe = 'F';
								$color = '#E04D30';
								break;
	
							case 7:
								$dpe = 'G';
								$color = '#E31929';
								break;
						}
                    
					echo '<div class="more">';
					
					echo '<form method="POST" action="updateBien.php">';
					echo '<div class="content mx-auto text-centred card mt-5">';

					echo '<a class="btn btn-outline-danger btn-block btn-lg sticky-top mt-2 mb-2" href="conseiller.php?menu=1">Retour</a>';

					echo '<input type="number" value="'.$respond['identifiant_bien'].'" name="id_bien" id="id_bien" style="display: none;" />';
					

					echo '<div id="img" class="card-img"  style="background: url(../'.$respond['url'].');
					height: 500px;
				    width: 250px;
				    background-clip: border-box;
				    background-size: cover;">
				    <div id="img-overlay" class="w-25 left" title="precedent" onclick="precedent()"><img src="../img/fleche_gauche.jpg" /></div><div id="center img-overlay" class="w-50" onclick="fullScreenMode()" title="cliquez pour agrandir/rétrécir"></div><div id="img-overlay" class="w-25 right" title="suivant" onclick="suivant()" style="z-index: 10;"><img src="../img/fleche_droite.jpg" /></div>
				    </div>';

					echo '<div class="card-body">
					<div class="moreInfo card-header">
				    	<div id="bloc1">
							<div class="type" style="padding-top: 0; font-size: 30px;">
								<input type="text" id="type_bien" value="'.$respond['type_bien'].'" name="type_bien"  class="form-control form-sm"/>
				    		</div>
				    		<div class="surface card-text form-inline">
				    			'.$respond['surface_habitable'].'m²
				    		</div>
				    		<div class="nb_piece card-text form-inline">
				    			'.$respond['nb_piece'].' pièces
				    		</div>
				    		<div class="prix card-text" style="margin: 8px; margin-left: auto;">
								'.$transaction.' '.$respond['prix'].$type.' 
								<div class="form-control-sm form-inline">
									<div class="input-group ml-5">
										<div class="input-group-prepend">
											<button class="btn btn-outline-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$transaction.'</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" value="1">A louer</a>
												<a class="dropdown-item" value="2">A vendre</a>
											</div>
										</div>
										<input type="number" placeholder="Montant" id="prix" name="prix" class="form-control" />
									</div>
								</div>
				    		</div>
				    	</div>
				    	<div id="bloc2">
				    		<div id="localité" class="mb-2 card-text text-muted">
				    			'.$respond[28].' ('.$respond['codePostal'].') | '.$respond[32].'
				    		</div>
				    	</div>
				    	<div id="description">
				    		<h2 class="card-subtitle text-danger ml-1">Déscriptif du bien</h2>
				    		<div id="ref">
				    			<div id="reference" class="card-text"><small class="text-muted">
				    				Réference annonce : '.$recherche.'</small>
				    			</div>
				    		</div>
				    		<div id="nb_sdb">
				    			Nombre de salle de bain : '.$respond['nb_sdb'].'
				    		</div>
				    		<div id="descript" class="mx-5 my-3 form-inline">
								<textarea type="text" id="descript_modify" name="descript_modify" class="form-control w-75 h-75 ml-1">
									'.utf8_encode($respond['description_bien']).'
								</textarea>
				    		</div>
				    	</div>
				    	<div id="technicalInfo" class="card-text">
							<div class="card-text"> 
								<h4 class="title text-danger ml-1">
									Spécifications
								</h4><br />
								<div class="row">
									<div class="card-text col-sm form-inline">
										<span class="text-danger">Surface habitable :</span> 
										<input type="number" id="surface_modify" name="surface_modify" value="'.$respond['surface_habitable'].'" class="form-control ml-1" />
										m²
									</div>
									<div class="col-sm card-text">
										';
										if($respond['surface_terrain'] == '0')
											{
												echo '<span class="text-danger">Pas de terrain.</span>';
											}

										else
											{
												echo '<span class="text-danger">Surface du terrain :</span> '.$respond['surface_terrain'].'m²';
											}
										echo '
									</div>
									<div class="col-sm form-inline">
											<span class="text-danger">Nombre de pièces :</span>    
											<input type="number" id="nb_piece_modify" name="nb_piece_modify" value="'.$respond['nb_piece'].'" class="form-control ml-1" />
											dont
											<input type="number" id="nb_chambre_modify" name="nb_chambre_modify" value="'.$respond['nb_chambre'].'" class="ml-1 form-control" />
											chambres
									</div>
								</div>
								<div class="row">
									<div class="col-sm form-inline">
											<span class="text-danger">Salles de bain :</span> 
											<input type="number" id="nb_sdb_modify" name="nb_sdb_modify" value="'.$respond['nb_sdb'].'" class="form-control ml-1 w-50" />
									</div>
									<div class="col-sm form-inline">
											<span class="text-danger">Toilettes :</span> 
											<input type="number" id="nb_wc_modify" name="nb_wc_modify" value="'.$respond['nb_wc'].'" class="form-control ml-1 w-50" />
									</div>
									<div class="col-sm form-inline">
											<span class="text-danger">Nombres de placards :</span> 
											<input type="number" id="nb_placard_modify" name="nb_placard_modify" value="'.$respond['nb_placard'].'" class="form-control ml-1 w-50" />
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
											<span class="text-danger">Année de construction :</span> '.$respond['annee_construction'].'
									</div>
									<div class="col-sm">
											<span class="text-danger">Adresse du bien :</span> '.utf8_encode($respond['adresse_bien']).'
									</div>
									<div class="col-sm">
										<span class="text-danger"> Place de parking : </span>';
											
										echo '<input type="number" class="form-control ml-1 w-50" value="'.$respond['nb_place_parking'].'" id="place_parking" name="parking_id" />
											<input type="hidden" disabled   id="parking_id" name="parking_id" value="'.$respond['ID_parking'].'" /> ';
												
									echo '	
									</div>
								</div>
								<div class="row">
									<div class="col-sm form-inline">
												<img src="../img/dpe.png" style="width: 80px; height: 80px;" /> 
												<span style="border-radius: 50px; padding: 0px 6px; color: white; background: '.$color.';"> '.$dpe.'</span>
												<select id="dpe_modify" name="dpe_modify" class="form-contol ml-1">
													<option default value="'.$respond['dpe'].'">'.$dpe.'</option>
													<option value="1">A</option>
													<option value="2">B</option>
													<option value="3">C</option>
													<option value="4">D</option>
													<option value="5">E</option>
													<option value="6">F</option>
													<option value="7">G</option>
												</select>
									</div>
								</div>
							</div>
							<div class="card-text">
								<h4 class="title card-text text-danger ml-1">
									A propos du propriètaire
								</h4>
								<div class="row">
									<div class="col-sm">
										<select id="proprio_id" name="proprio_id">';
									
										$idProQuery = $bdd->query('SELECT * FROM proprietaire');

										$idProprio = $idProQuery->fetch();

										while($idProprio != null)
												{
													echo '<option value="'.$idProprio['ID'].'">'.$idProprio['nom_proprio'].', '.$idProprio['prenom_proprio'].'</option>';
													$idProprio = $idProQuery->fetch();
												}

									echo '</select>
									</div>
								</div>
								<div class="row">
									<div class="col-sm">
										<span class="text-danger">Nom : </span>'.$respond['nom_proprio'].'
									</div>
									<div class="col-sm">
										<span class="text-danger">Prénom : </span>'.$respond['prenom_proprio'].'
									</div>
									<div class="col-sm">
												<span class="text-danger">Adresse : </span>'.utf8_encode($respond['adresse_proprio']).', '.$respondProprio['codePostal'].' | '.$respondProprio['nom'].'
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">
										<span class="text-danger">Numéro : </span>+33'.$respond['num_proprio'].'
									</div>
									<div class="col-sm-4">
										<span class="text-danger">Mail : </span>'.$respond['mail_proprio'].'
									</div>
								</div>
							</div>
				    	</div>';

					echo '</div>
						<button type="submit" class="btn btn-outline-danger btn-block btn-lg mt-3" id="modify">Enregistrer</button>
						</div>';
					echo '</form>';
			}





?>