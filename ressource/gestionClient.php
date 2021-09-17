<?php

$conseillerQuery = $bdd->query('SELECT * FROM conseiller WHERE conseiller.mail ="'.$_SESSION['mail'].'"');

$conseiller = $conseillerQuery->fetch();

$_SESSION['ID_conseiller'] = $conseiller['ID'];

$clientQuery = $bdd->query('SELECT * FROM proprietaire WHERE ID_conseiller_proprio = '.$_SESSION['ID_conseiller'].'');

$client = $clientQuery->fetch();

?>
<button class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#pop">+ Ajouter un client</button>

<div class="modal" id="pop">
    <div class="modal-dialog modal-dialog-lg modal-dialog-centred">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Ajouter un client</h5>
                <button class="close text-white" data-dismiss="modal"> &times; </button>
            </div>
            <div class="modal-body">
                <form method="post" action="addClient.php">
                    <small class="form-text text-muted">Nom</small>
                    <input type="text" id="nom" name="nom" class="form-control mb-2" required />
                    <small class="form-text text-muted">Prénom</small>
                    <input type="text" id="prenom" name="prenom" class="form-control mb-2" required />
                    <small class="form-text text-muted">Adresse mail</small>
                    <input type="mail" id="mail" name='mail' autocomplete="mail" required class="form-control mb-2" />
                    <small class="form-text text-muted">Numéro de télèphone</small>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="num">+33</span>
                        </div>
                        <input type="number" id="num" name="num" class="form-control" required />
                    </div>
                    <small class="form-text text-muted">Adresse postale</small>
                    <input type="text" id="adresse" name="adresse" class="form-control mb-2" required />
                    <small class="form-text text-muted">Ville</small>
                    <input type="text" id="ville" name="ville" required class="form-control mb-2" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-danger btn-block">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="content d-sm-flex">
<?php 

while($client != null)
    { 
        $countryQuery = $bdd->query('SELECT * FROM ville WHERE ID = '.$client['ID_ville_proprio'].'');

        $country = $countryQuery->fetch();

        ?>
        <div class="card w-25 mt-4 mx-auto">
            <form method="post" action="updateClient.php">
            <div class="card-header">
                <button type="button" class="close" onclick="deleted(<?php echo $client['ID']; ?>)"> &times; </button>
                <h4 class="card-title">Carte client</h4>
                <div class="card-content">
                    <label for="clientName">
                        Nom :
                    </label>
                    <input type="text" class="form-control" id="clientName" name="clientName" value="<?php echo $client['nom_proprio']; ?>" />
                    <br /> 
                    <label for="clientPrenom">
                        Prenom :
                    </label>
                    <input type="text" class="form-control" name="clientPrenom" id="clientPrenom" value="<?php echo $client['prenom_proprio']; ?>" />
                </div>
                <div class="card-body">
                    <label for="mail_proprio">
                        Adresse mail :
                    </label>
                    <input type="text" class="form-control" name="mail_proprio" id="mail_proprio" value="<?php echo $client['mail_proprio']; ?>" />
                    <label for="num_proprio">
                        Numero de téléphone :
                    </label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="num_proprio">+33</span>
                        </div>
                        <input type="text" class="form-control" name="num_proprio" id="num_proprio" value="<?php echo $client['num_proprio']; ?>" />
                    </div>
                    

                    <label for="adresse_proprio">
                        Adresse :
                    </label>
                    <input type="text" class="form-control" name="adresse_proprio" id="adresse_proprio" value="<?php echo $client['adresse_proprio']; ?>" />
                    <label for="ville_proprio">
                        Ville :
                    </label>
                    <input type="text" class="form-control" name="ville_proprio" id="ville_proprio" value="<?php echo $country['nom']; ?>" />
                    
                    <input type="text" class="form-input sr-only" id="client_ID" name="client_ID" value="<?php echo $client['ID']; ?>" />

                    <input type="hidden" class="sr-only" value="_charset_utf8_ci" />
                </div>
                <button type="submit" class="btn btn-outline-danger btn-block">
                    Enregistrer
                </button>
            </div>
            </form>
        </div>
        <?php 
        $client = $clientQuery->fetch();
        }
        ?>
</div>