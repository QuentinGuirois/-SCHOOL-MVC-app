<?php
//APPEL VIEW ET MODEL
include_once './view/viewCategory.php';
include_once './models/modelCategory.php';


class CategoryController {
    private $model;
    private $view;
    private $paramGet;
    private $paramPost;

    public function __construct() {
        $this->view = new ViewCategory();
        $this->model = new ModelCategory();
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
}