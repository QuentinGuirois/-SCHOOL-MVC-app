<?php

class HomeView {
    //ATTRIBUT 
    private $page;

    //CONSTRUCTEUR
    public function __construct() {
        $this->page = $this->searchHTML('header');
        $this->page .= $this->searchHTML('nav');
        
    }

    //AFFICHAGE ACCUEIL
    public function displayHome(){
        
        $this->page .= "<h1 class=\"display-1\">Bienvenue sur la page d'accueil</h1>";
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



