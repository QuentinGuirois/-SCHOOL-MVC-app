<?php
//INCLUSION CONTROLLER
include_once("controllers/HomeController.php");
include_once("controllers/CategoryController.php");
include_once("controllers/ClientsController.php");
include_once("controllers/ProspectsController.php");

class Dispatcher {
    public function dispatch() {
        $controller = (isset($_GET['controller'])) ?$_GET['controller']:"home";
        $controller = $controller."Controller";
        
        $action = (isset($_GET['action']))?$_GET['action']:"list";
        $action = $action."Action";

        $my_controller = new $controller();
        $my_controller->$action();  
        $my_controller->dispatch();
        }
    }

//INSTANCIATION

$dispatch = new Dispatcher;
$dispatch->dispatch();


