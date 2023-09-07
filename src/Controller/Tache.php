<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Entity\Tache as TacheObj;

class Tache extends AbstractController {
    private string $titlePage = 'Page d\'une tâche';
    private string $mode = 'view';

    public function index()
    {
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('tache.php')
        ->setFooter('footer.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => $this->titlePage,
            'windowName' => 'Gestion de Projets - Tache',
            //'projet' => $this->projet ?? null,
            //'taches' => $this->taches,
            //'tachesAll' => $this->tachesAll ?? [],
            'mode' => $this->mode,
            'isConnected' => Securite::isConnected()
        ]);
    }
}
?>