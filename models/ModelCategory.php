<?php

class ModelCategory {

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
    
    //LISTER TABLE BDD CATEGORY
    public function getList() {
        $this->requete="SELECT * FROM category";
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
    
    //AJOUT CATEGORY
    public function add($parmForm) {
        $sql = 'INSERT INTO category VALUES (NULL, :parm1, :parm2)';
        $this->requete = $this->connection->prepare($sql);
        $this->requete->bindParam(':parm1', $parmForm['parm1']);
        $this->requete->bindParam(':parm2', $parmForm['parm2']);
        $this->executeTryCatch();


    }
    
    //MODIF CATEGORY
    public function update($parmForm) {
        $this->requete = 'UPDATE category SET nom=:parm1, description=:parm2 WHERE id=:parm0';
        $this->requete = $this->connection->prepare($this->requete);
        $this->requete->bindParam(':parm0', $parmForm['parm0']);
        $this->requete->bindParam(':parm1', $parmForm['parm1']);
        $this->requete->bindParam(':parm2', $parmForm['parm2']);
        $this->executeTryCatch();
    }
    
    //SUPPR UTILISATEUR
    public function delete ($parmForm) {
        $this->requete = 'DELETE FROM category WHERE id=:parm0';
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