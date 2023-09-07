<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;

class Connexion extends AbstractController{

    //private static bool $isConnected;

    public function index()
    {
        if (isset($_POST["email"]) && isset($_POST["mdp"])) {
            Securite::connect();
        }
        //self::$isConnected = Securite::isConnected();
        $view = new View();
        //$users= Users::getAll();

        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('connexion.php')
        ->setFooter('footer.html');


        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page Connexion',
            'windowName' => 'Gestion de Projets - Connexion',
            'isConnected' => Securite::isConnected()
            //'projets' => $projets,
            //'users'=> $users,
        ]);
    }

    public function test() {
        echo 'fonction test';
    }

}
?>