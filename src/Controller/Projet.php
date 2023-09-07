<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Entity\Projet as ProjetObj;

class Projet extends AbstractController {
    private string $mode;

    private ProjetObj $projet; 

    public function index()
    {
        

        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('projet.php')
        ->setFooter('footer.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page d\'un projet',
            'windowName' => 'Gestion de Projets - Projet',
            'projet' => $this->projet ?? null,
            'mode' => $this->mode,
            'isConnected' => Securite::isConnected()
        ]);
    }

    public function edit() {
        if (Securite::isConnected()) {
            if(isset($_GET['id'])) {
                $id_projet = $_GET['id'];
                $this->projet = ProjetObj::getById($id_projet);
            }            
        }
        $this->mode = 'edit';
        $this->index();
    }
}
?>