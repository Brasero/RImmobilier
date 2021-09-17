<?php

    $conseillerQuery = $bdd->query('SELECT * FROM conseiller WHERE mail = "'.$_SESSION['mail'].'"');
    $conseiller = $conseillerQuery->fetch();

$query = $bdd->query('SELECT * FROM bien WHERE ID_conseiller_bien = "'.$conseiller['ID'].'"');

$bien = $query->fetch();

echo '<a class="btn btn-outline-danger btn-block" href="addBien.php">+ Ajouter un bien</a>';
echo '<div id="content" class="d-sm-flex p-3">';
while($bien != null)
    {

        $i = 0;

        $cuisineQuery = $bdd->query('SELECT * FROM cuisine WHERE ID = '.$bien['ID_cuisine'].'');
        $cuisine = $cuisineQuery->fetch();//Contient les infos de la cuisine du bien
        



        $garageQuery = $bdd->query('SELECT * FROM garage WHERE ID = '.$bien['ID_garage'].'');
        $garage = $garageQuery->fetch();//Contient les infos du garage du bien
        


        $grenierQuery = $bdd->query('SELECT * FROM grenier WHERE ID = '.$bien['ID_grenier'].'');
        $grenier = $grenierQuery->fetch();//Contient les infos du grenier du bien
        


        $caveQuery = $bdd->query('SELECT * FROM cave WHERE ID = '.$bien['ID_cave'].'');
        $cave = $caveQuery->fetch();//Contient les infos de la cave du bien 
        

        $parkQuery = $bdd->query('SELECT * FROM parking WHERE ID = '.$bien['ID_parking'].'');
        $park = $parkQuery->fetch();//Contient les infos du parking du bien 

        $villeQuery = $bdd->query('SELECT * FROM ville WHERE ID = '.$bien['ID_ville_bien'].'');
        $ville = $villeQuery->fetch();//contient les infos de la ville du bien

        $proprioQuery = $bdd->query('SELECT * FROM proprietaire WHERE ID = '.$bien['ID_proprietaire'].'');
        $proprio = $proprioQuery->fetch();

        $photoQuery = $bdd->query('SELECT * FROM photo WHERE ID_bien = '.$bien['ID'].'');
        $photo = $photoQuery->fetchAll();

        if($bien['transaction'] == 0)
        {
            $transaction = 'à vendre';
            $type = '€';
        }

        else if($bien['transaction'] == 1)
        {
            $transaction = 'à louer';
            $type = "€/mois";
        }

        echo '<div class="card mx-1 my-1 rounded">
                <div class="card-body">
                <div class="identifiant card-title">
                    '.$bien['identifiant_bien'].'
                </div>
                <div class="type">
                    '.$bien['type_bien'].'
                </div>
                <div class="adress">
                    '.$bien['adresse_bien'].'
                </div>
                <div class="ville">
                    '.$ville['nom'].'
                </div>
                <div class="proprio">
                    <div class="nom">
                        '.$proprio['nom_proprio'].
                    '</div>
                    <div class="prenom">
                        '.$proprio['prenom_proprio'].'
                    </div>
                    <div class="adresse">
                        '.$proprio['adresse_proprio'].'
                    </div>
                </div>
                <div class="text-danger">
                    Bien '.$transaction.', '.$bien['prix'].$type.'.
                </div>
                
                <div class="carousel slide w-100 my-2 rounded" data-ride="carousel">
                    <div class="carousel-inner">';

        foreach($photo as $pic)
        {
            $i++;

            if($i == 1)
            {
                echo '<div class="carousel-item active">
                        <img class="d-block w-100" src="../'.$pic['url'].'" />
                      </div>';
            }

            else
            {
                echo '<div class="carousel-item">
                        <img class="d-block w-100" src="../'.$pic['url'].'" />
                      </div>';
            }
        }

        echo '      </div>
                </div>
                <button class="btn btn-block btn-outline-danger" id="'.$bien['identifiant_bien'].'" onclick="addMoreConseiller('.$bien['identifiant_bien'].')">
                    Modifier
                </button>
                </div>
            </div>';
        
        $bien = $query->fetch();

    }

    
?>
</div>

<script type="text/javascript" src="../script/function.js"></script>