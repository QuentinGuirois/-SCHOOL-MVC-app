<?php

class ViewCategory {
    
   //CONSTRUCTEUR
     //ATTRIBUT 
     private $page;

     //CONSTRUCTEUR
     public function __construct() {
         $this->page = $this->searchHTML('header');
         $this->page .= $this->searchHTML('nav');
         
     }  
    //**AFFICHAGE LISTE DES CATEGORIES
    public function displayList($list) {
        $this->page .= "<h1 class=\"display-1\">Liste des Categories</h1>";
        
        //STOCKAGE LISTE <TABLE>
        //VAR
        $tableau = '<div class="container">'
        . '<table class="table table-dark" cellspacing="0">'
        . '<thead>'
        . '<th>Nom</th><th>Description</th><th>Modification</th><th>Suppression</th>'
        . '</thead><tbody>';

        //RECUP ET INSERTION LISTE DANS TABLEAU
        foreach($list as $ligne) {
            $tableau .= "<tr><td>$ligne[1]</td>"
            ."<td>$ligne[2]</td>"
            ."<td><a href=\"index.php?controller=Category&action=update&parm0=$ligne[0]&parm1=$ligne[1]&parm2=$ligne[2]\"><i class=\"fas fa-pen-nib\"></i></a></td>"
            ."<td><a href=\"index.php?controller=Category&action=delete&parm0=$ligne[0]&parm1=$ligne[1]&parm2=$ligne[2]\"><i class=\"fas fa-trash-alt\"></i></a></td></tr>";
            

        }
        
        //AJOUT BALISES HTML
        $tableau .= "</tbody></table></div>";
        $this->page .= $tableau;
        $this->display();

    }

    //**AFFICHAGE PAGE AJOUT CATEGORY
    public function displayAdd() {
        $this->page .= "<h1 class=\"display-1\">Bienvenue sur la page d'ajouts de Categorie</h1>";
        $paramaters = array(
            "readonly"=>"",
            "parm0"=>"",
            "parm1"=>"",
            "parm2"=>"",
            "action"=>"add",
            "lib_action"=>"Ajout");
        
        $this->displayForm($paramaters);
    }
    
     //**AFFICHAGE PAGE MODIF CATEGORY
     public function displayUpdate($paramGet) {
        //var_dump ($paramGet);
        $this->page .= "<h1 class=\"display-1\">Modification de Categorie</h1>";
        $paramaters = array(
            "readonly"=>"",
            "parm0"=>$paramGet['parm0'],
            "parm1"=>$paramGet['parm1'],
            "parm2"=>$paramGet['parm2'],
            "action"=>"update",
            "lib_action"=>"Modifier"
        );
        $this->displayForm($paramaters);
    }
    
    //**AFFICHAGE PAGE SUPPRESSION CATEGORY
    public function displayDelete($paramGet) {
        $this->page .= "<h1 class=\"display-1\">Suppression de Categorie</h1>";
        $paramaters = array(
            "readonly"=>"readonly",
            "parm0"=>$paramGet['parm0'],
            "parm1"=>$paramGet['parm1'],
            "parm2"=>$paramGet['parm2'],
            "action"=>"delete",
            "lib_action"=>"Supprimer"
        );
        
        $this->displayForm($paramaters);
    }

     //*AFFICHAGE FORMULAIRE CATEGORY
    private function displayForm($paramaters) {
        $this->page .= $this->searchHTML('formCategory');
        $this->page = str_replace("{readonly}", $paramaters["readonly"], $this->page);
        $this->page = str_replace("{parm0}", $paramaters["parm0"], $this->page);
        $this->page = str_replace("{parm1}", $paramaters["parm1"], $this->page);
        $this->page = str_replace("{parm2}", $paramaters["parm2"], $this->page);
        $this->page = str_replace("{action}", $paramaters["action"], $this->page);
        $this->page = str_replace("{lib_action}", $paramaters["lib_action"], $this->page);
        $this->display();
    }
    //AFFICHAGE PAGE GLOBAL
    public function display(){
        $this->page .= $this->searchHTML('footer');
        echo $this->page;
    }

    //EXTRACTION DES DONNEES FICHIERS HTML
    public function searchHTML($filename) {
        $content = file_get_contents('.\html\\'.$filename.'.html');
        return $content;
    }
}