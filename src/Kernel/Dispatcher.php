<?php

namespace Jacques\ProjetPhpGestionProjets\Kernel;
use Jacques\ProjetPhpGestionProjets\Configuration\Config;

class Dispatcher {
    private $controller;
    private $method;

    public function __construct()
    {
/*
        $this->controller = $_SERVER["DOCUMENT_ROOT"] . '/src/Controller/Home.php';
        //echo $this->controller;
        $this->method = 'index';
        $isPageOk = false;
        if (isset($_GET['page'])) {
            $controllerFile = $_SERVER["DOCUMENT_ROOT"] . '/src/Controller/' . $_GET['page'] . '.php';
            if (file_exists($controllerFile)) {
                $this->controller = $controllerFile;
                //include_once $this->controller;
                $isPageOk = true;
            }
        }

        if (isset($_GET['method']) && $isPageOk) {
            //$this->method = $_GET['method'];

            $className = basename($this->controller, '.php');
            echo $className;
            $object = new $className();
            $methodName = $_GET['method'];
            if (method_exists($object, $methodName)) {
                $this->method = $methodName;
            }
        }*/


        
        $this->controller = Config::CONTROLLER .'Home';
        $this->method = 'index';
        $isClassOk = false;
        if (isset($_GET['page'])) {    
            //$this->controller = Config::CONTROLLER.$_GET['page'];
            //$isClassOk = true;
            //echo 'class exists : ' . class_exists(Config::CONTROLLER.$_GET['page']);
            
            if(class_exists(Config::CONTROLLER.$_GET['page'])) {
                $this->controller = Config::CONTROLLER.$_GET['page'];
                $isClassOk = true;
            }
            
        }
        if (isset($_GET['method']) && $isClassOk) {
            //$this->method = $_GET['method'];
            
            if (method_exists($this->controller, $_GET['method'])) {
                $this->method = $_GET['method'];
            } else {
                $this->controller = Config::CONTROLLER . 'Home';
                // $this->method = 'index';
            }
            
        }
    }

    public function Dispatch() {
        // echo 'je suis ds le controller ' .$this->controller;
        // die;
        $method = $this->method;
        //var_dump($this->controller);
        $cont = new $this->controller;
        // $cont->index();
        $cont->$method();

    }
}