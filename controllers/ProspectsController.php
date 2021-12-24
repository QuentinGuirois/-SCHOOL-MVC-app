<?php
//APPEL VIEW ET MODEL
include_once "./view/viewProspects.php";
include_once "./models/modelProspects.php";


class ProspectsController {
    private $model;
    private $view;
    private $paramGet;
    private $paramPost;

    public function __construct() {
        $this->view = new ViewProspects();
        $this->model = new ModelProspects();
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
        $list= $this->model->getList();
        $this->view->displayList($list);
    }

    public function addAction(){
        $this->model->add($this->paramPost['action']);
        $this->view->displayAdd();
    }

    public function updateAction(){
        $this->model->update($this->paramPost['action']);
        $this->view->displayUpdate($this->paramGet); 
    }

    public function deleteAction(){
        $this->model->delete($this->paramPost['action']);
        $this->view->displayDelete($this->paramGet);
    }
    public function transfertAction(){
        $this->model->transfert($this->paramPost['action']);
        $this->view->displayTransfert($this->paramGet);
        
    }
}