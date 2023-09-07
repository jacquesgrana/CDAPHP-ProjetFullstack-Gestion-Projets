<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

//use Digi\Keha\Entity\Users;
use Jacques\ProjetPhpGestionProjets\Kernel\View;
//use Digi\Keha\Utils\MyFunction;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Entity\Projet;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;


class Home extends AbstractController{

    public function index()
    {
        $projets = Projet::getAll();

        $view = new View();
        //$users= Users::getAll();

        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('home.php')
        ->setFooter('footer.html');


        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page Accueil',
            'windowName' => 'Gestion de Projets - Accueil',
            'projets' => $projets,
            'isConnected' => Securite::isConnected()
        ]);
    }

    public function disconnect() {
        //echo 'deco';
        Securite::disconnect();
        self::index();
    }

}