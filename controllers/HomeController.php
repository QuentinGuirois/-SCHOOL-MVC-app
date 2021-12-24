<?php
//APPEL VIEW ET MODEL
include_once './view/view.php';


class HomeController {
    private $view;
    private $paramGet;
    private $paramPost;

    public function __construct() {
        $this->view = new HomeView();
        $this->paramGet = (!empty($_GET)) ?$_GET:array('action'=>'home');
        $this->paramPost = (!empty($_POST)) ?$_POST:null;
    }

    //ATTRIBUTION PARAMETRES EN GET
    public function dispatch() {
        //SI DONNEES EN POST
        if($this->paramPost){
            $method = $this->paramPost['action'];
            $this->model->$method($this->paramPost);
        };}

    public function listAction(){
        $this->view->displayHome();
    }
  
}