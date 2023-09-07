<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
//use Jacques\ProjetPhpGestionProjets\Utils\TacheDB;
use Jacques\ProjetPhpGestionProjets\Entity\Tache as TacheObj;
use Jacques\ProjetPhpGestionProjets\Entity\Statut;
use Jacques\ProjetPhpGestionProjets\Entity\Priorite;
use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;

class Tache extends AbstractController {
    private string $titlePage = 'Page d\'une tâche';
    private string $mode = 'view';
    private TacheObj $tache;
    private array $statuts;
    private array $priorites;
    private array $utilisateurs;

    public function index()
    {
        $this->statuts = Statut::getAll();
        $this->priorites = Priorite::getAll();
        $this->utilisateurs = Utilisateur::getAll();
/*
        var_dump($this->statuts);
        echo '<br />';
        echo '<br />';
        var_dump($this->priorites);
        echo '<br />';
        echo '<br />';
        var_dump($this->utilisateurs);
*/
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('tache.php')
        ->setFooter('footer.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => $this->titlePage,
            'windowName' => 'Gestion de Projets - Tache',
            'tache' => $this->tache ?? null,
            'mode' => $this->mode,
            'statuts' => $this->statuts,
            'priorites' => $this->priorites,
            'utilisateurs' => $this->utilisateurs,
            'isConnected' => Securite::isConnected()
        ]);
    }

    public function edit() {
        if (Securite::isConnected()) {
            if(isset($_GET['id'])) {
                $id_tache = $_GET['id'];
                $this->tache = TacheObj::getById($id_tache);
            }
        }
        $this->mode = 'edit';
        $this->titlePage = 'Page d\'édition d\'une tâche';
        $this->index();
    }

    public function view() {
        if (Securite::isConnected()) {
            if(isset($_GET['id'])) {
                $id_tache = $_GET['id'];
                $this->tache = TacheObj::getById($id_tache);
            }
        }
        $this->mode = 'view';
        $this->titlePage = 'Page de consultation d\'une tâche';
        $this->index();
    }

    public function create() {
        $this->mode = 'create';
        $this->titlePage = 'Page de création d\'une tâche';
        $this->index();
    }
}
?>