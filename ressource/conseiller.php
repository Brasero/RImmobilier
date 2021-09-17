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

?>

<!DOCTYPE HTML>
<html>
   <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../css/stylesheet2.css" />
        <link rel="stylesheet" href="../css/conseillerStyle.css" />
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <title>Espace conseiller</title>
   </head> 

    <body class="text-centred">
        <nav>
            <h1>RImmobilier</h1>
            <ul>
                <a href="conseiller.php?menu=1"><li>Gestion des biens</li></a>
                <a href="conseiller.php?menu=2"><li>Gestion clients</li></a>
                <a href="../index.php"><li>Retour</li></a>
            </ul>
        </nav>
        <header>
            <div id="headerContainer">
                <div id="header1">
                    <p>
                        Bienvenue dans votre espace conseiller, <?php echo $_SESSION['nom'].' '.$_SESSION['prenom']; ?>. 
                    </p>
                </div>
                <div id="header2">
                    <h1>RImmobilier</h1>
                </div>     
            </div>
        </header>
        <div id="container">

            <?php

                if(isset($_GET['menu']))
                    {
                        if($_GET['menu'] == 1)
                            {
                                include('gestionBien.php');
                            }

                        elseif($_GET['menu'] == 2)
                            {
                                include('gestionClient.php');
                            }
                    }

                else
                    {
                        echo '<div>A vous de jouer</div>';
                    }
            

            ?>

        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="../script/function.js" type="text/javascript"></script>
    </body>

</html>