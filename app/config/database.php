<?php

class Database{


    private $host= "localhost";
    private $dbName= "immobilier";
    private $char= "utf8";
    private $user= 'root';
    private $mdp = '';
    public $connexion;

    public function getConnexion(){

        $this->connexion = null;

        try
        {
            $this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset='.$this->char, $this->user, $this->mdp);
        }
        catch(PDOException $e)
        {
            echo 'Erreur de connexion : '.$e->getMessage();
        }
    }
}

?>
