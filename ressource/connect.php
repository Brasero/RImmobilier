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

$query = $bdd->query('SELECT * FROM user');

$user = $query->fetch();
if(isset($_POST['username']))
        {
            while($user != null)
                {
        
                    if($_POST['username'] == $user['username'] && $_POST['mdp'] == $user['mdp'])
                    {
                        $_SESSION['id'] = $user['ID'];
                        $_SESSION['user'] = $user['username'];
                        $_SESSION['mdp'] = $user['mdp'];
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['prenom'] = $user['prenom'];
                        $_SESSION['mail'] = $user['mail'];
                        $_SESSION['employe'] = false;
                        $query2 = $bdd->query('SELECT * FROM conseiller');
                        $conseiller = $query2->fetch();

                        while($conseiller != null)
                            {
                                if($_SESSION['mail'] == $conseiller['mail'])
                                    {
                                        $_SESSION['employe'] = true;
                                        break;
                                    }

                                else
                                    {
                                        $conseiller = $query2->fetch();
                                    }
                            }

                        header('Location: ../index.php');

                        break;
                    }

                    else
                        {
                            $user = $query->fetch();
                        }
        
                }

                header('Location: ../index.php');
        }

       
?>
