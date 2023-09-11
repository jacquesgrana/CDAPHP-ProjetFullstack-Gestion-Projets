<?php

namespace Jacques\ProjetPhpGestionProjets\Kernel;
use Jacques\ProjetPhpGestionProjets\Configuration\Config;

/**
 * Classe chargée de router les requêtes.
 * Crée le contrôleur correspondant à 'page' (de la querystring) 
 * et appelle la méthode 'method' (de la querystring) du contrôleur 
 * dans la méthode dispatch().
 */
class Dispatcher {
    private $controller;
    private $method;

    /**
     * Constructeur, récupère les données (page, method) de la querystring 
     * et teste l'existence du contrôleur et récupère son nom 
     * (avec namespace), puis teste l'existence de la méthode et 
     * récupère son nom.
     */
    public function __construct()
    {
        $this->controller = Config::CONTROLLER .'Home';
        $this->method = 'index';
        $isClassOk = false;
        if (isset($_GET['page'])) {                
            if(class_exists(Config::CONTROLLER . $_GET['page'])) {
                $this->controller = Config::CONTROLLER . $_GET['page'];
                $isClassOk = true;
            }   
        }
        if (isset($_GET['method']) && $isClassOk) {
            if (method_exists($this->controller, $_GET['method'])) {
                $this->method = $_GET['method'];
            } else {
                $this->controller = Config::CONTROLLER . 'Home';
            }
        }
    }

    /**
     * Crée le contrôleur $this->controller 
     * et appelle la méthode $this->method.
     */
    public function Dispatch() {
        $method = $this->method;
        $cont = new $this->controller;
        $cont->$method();
    }
}