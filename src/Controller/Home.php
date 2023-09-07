<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Utils\ProjetDB;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;


class Home extends AbstractController{

    public function index()
    {
        if (Securite::isConnected()) {
            $id = $_SESSION['user_id'];
            //echo 'id : ' . $id . '<br />';
            $projetsDirected = ProjetDB::getByDirectorUserId($id);
        }
        
        //$projetsDirected = Projet::getAll(); 

        $view = new View();

        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('home.php')
        ->setFooter('footer.html');


        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page Accueil',
            'windowName' => 'Gestion de Projets - Accueil',
            'projetsDirected' => $projetsDirected ?? null,
            'isConnected' => Securite::isConnected()
        ]);
    }

    public function disconnect() {
        //echo 'deco';
        Securite::disconnect();
        self::index();
    }

}