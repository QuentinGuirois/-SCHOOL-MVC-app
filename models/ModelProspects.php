<?php

class ModelProspects {

    private $connection;
    private $requete;

    //PARAMETRES BDD
    public function __construct() {
        define('SERVER', "localhost");
        define('USER', "root");
        define('PASSWORD', "");
        define('BASE', "cefiidev1175");

        //CONNEXION
        try {
        $this->connection = new PDO("mysql:host=" . SERVER . ";dbname=" . BASE, USER, PASSWORD);
        echo "la connexion fonctionne <br/>";
        } catch (Exception $e) {
        die( "Oups ! Erreur de connexion : " . $e->getMessage());
        }

        //UTF8
        $this->connection->exec("SET CHARACTER SET utf8");
        
    }
   
    //LISTER TABLE BDD PROSPECTS
    public function getList() {
        $this->requete="SELECT * FROM prospects";
        $list = null;

        try
        {
            $resultat = $this->connection->query($this->requete);
            if ($resultat) {
                $list = $resultat->fetchAll(PDO::FETCH_NUM);
            }
        }
        catch (Exception $e)
        {
            die('Oups ! Erreur : ' . $e->getMessage());
        }
        return $list;
    }
   
    //AJOUT PROSPECTS
    public function add($parmForm) {
        $sql = 'INSERT INTO prospects VALUES (NULL, :parm1, :parm2, :parm3, :parm4, :parm5, :parm6)';
        $this->requete = $this->connection->prepare($sql);
        $this->requete->bindParam(':parm1', $parmForm['parm1']);
        $this->requete->bindParam(':parm2', $parmForm['parm2']);
        $this->requete->bindParam(':parm3', $parmForm['parm3']);
        $this->requete->bindParam(':parm4', $parmForm['parm4']);
        $this->requete->bindParam(':parm5', $parmForm['parm5']);
        $this->requete->bindParam(':parm6', $parmForm['parm6']);
        $this->executeTryCatch();


    }
   
    //AJOUT CLIENT
    public function transfert($parmForm) {
        $sql = 'INSERT INTO clients VALUES (NULL, :parm1, :parm2, :parm3, :parm4, :parm5, :parm6)';
        $this->requete = $this->connection->prepare($sql);
        $this->requete->bindParam(':parm1', $parmForm['parm1']);
        $this->requete->bindParam(':parm2', $parmForm['parm2']);
        $this->requete->bindParam(':parm3', $parmForm['parm3']);
        $this->requete->bindParam(':parm4', $parmForm['parm4']);
        $this->requete->bindParam(':parm5', $parmForm['parm5']);
        $this->requete->bindParam(':parm6', $parmForm['parm6']);
        $this->executeTryCatch();
        //delete
        $this->requete = 'DELETE FROM prospects WHERE idProspect=:parm0';
        $this->requete = $this->connection->prepare($this->requete);
        $this->requete->bindParam(':parm0', $parmForm['parm0']);
        $this->executeTryCatch();


    }
   
    //MODIF PROSPECTS
    public function update($parmForm) {
        $this->requete = 'UPDATE prospects SET nom=:parm1, prenom=:parm2, adresse=:parm3, cp=:parm4, ville=:parm5, commentaire=:parm6 WHERE idProspect=:parm0';
        $this->requete = $this->connection->prepare($this->requete);
        $this->requete->bindParam(':parm0', $parmForm['parm0']);
        $this->requete->bindParam(':parm1', $parmForm['parm1']);
        $this->requete->bindParam(':parm2', $parmForm['parm2']);
        $this->requete->bindParam(':parm3', $parmForm['parm3']);
        $this->requete->bindParam(':parm4', $parmForm['parm4']);
        $this->requete->bindParam(':parm5', $parmForm['parm5']);
        $this->requete->bindParam(':parm6', $parmForm['parm6']);
        $this->executeTryCatch();
    }
   
    //SUPPR PROSPECT
    public function delete ($parmForm) {
        $this->requete = 'DELETE FROM prospects WHERE idProspect=:parm0';
        $this->requete = $this->connection->prepare($this->requete);
        $this->requete->bindParam(':parm0', $parmForm['parm0']);
        $this->executeTryCatch();
    }
    //ENCADREMENT & TEST METHODES
    private function executeTryCatch() {
        try
        {
            $this->requete->execute();
        }
        catch (Exception $e)
        {
            die('Oups ! Erreur : ' . $e->getMessage());
        }

        $this->requete->closeCursor();
    }
}