<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;

class Connexion extends AbstractController{

    public function index()
    {
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
            //'projets' => $projets,
            //'users'=> $users,
        ]);
    }

}
?>