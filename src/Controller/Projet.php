<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\TacheDB;
use Jacques\ProjetPhpGestionProjets\Entity\Projet as ProjetObj;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;
use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;
use Jacques\ProjetPhpGestionProjets\Utils\ProjetDB;

class Projet extends AbstractController {
    private string $mode;
    private ProjetObj $projet; 
    //private array $taches;
    private array $tachesAll;
    private string $titlePage = 'Page d\'un projet';
    private ?array $utilisateurs;


    public function index()
    {
        $this->utilisateurs = Utilisateur::getAll();
        // attention : verifier si vraiement necessaire
        if($this->mode !== 'create') {
            //$this->taches = TacheDB::getByProjetId($this->projet->getId_projet());
            $this->tachesAll = TacheDB::getAllByProjetId($this->projet->getId_projet());
        }
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('projet.php')
        ->setFooter('footer.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => $this->titlePage,
            'windowName' => 'Gestion de Projets - Projet',
            'projet' => $this->projet ?? null,
            //'taches' => $this->taches,
            'tachesAll' => $this->tachesAll ?? [],
            'mode' => $this->mode,
            'utilisateurs' => $this->utilisateurs,
            'isConnected' => Securite::isConnected()
        ]);
    }

    public function edit() {
        if (Securite::isConnected()) {
            if(isset($_GET['id'])) {
                $id_projet = $_GET['id'];
                $this->projet = ProjetObj::getById($id_projet);
                $_SESSION['id_projet'] = $id_projet;
            }            
        }
        $this->mode = 'edit';
        $_SESSION['mode_projet'] = $this->mode;
        $this->titlePage = 'Page d\'édition d\'un projet';
        $this->index();
    }

    public function view() {
        if (Securite::isConnected()) {
            if(isset($_GET['id'])) {
                $id_projet = $_GET['id'];
                $this->projet = ProjetObj::getById($id_projet);
                $_SESSION['id_projet'] = $id_projet;
            }            
        }
        $this->mode = 'view';
        $_SESSION['mode_projet'] = $this->mode;
        $this->titlePage = 'Page de consultation d\'un projet';
        $this->index();
    }

    public function create() {
        //$this->projet = null;
        $this->mode = 'create';
        $_SESSION['mode_projet'] = $this->mode;
        $this->titlePage = 'Page de création d\'un projet';
        $this->index();
    }

    public function deleteTache() {
        // recuperer l'id
        if(isset($_GET['id'])) {
            $id_tache = intVal($_GET['id']);
            // appeler fonction de TacheDB pour supprimer la tache
            $isOk = TacheDB::delete($id_tache);
            // selon retour afficher message
            ($isOk) ? $this->setFlashMessage('Suppression effectuée' , 'success') : $this->setFlashMessage('Suppression non effectuée' , 'error');
            // appeler index() pour afficher la page -> marche pas, pas le temps de chercher pourquoi...
            
            //Librairie::returnToProjet();
        }
        Librairie::returnToProjet();
        //$this->index();
    }

    public function update() {
        // tester et recuperer les variables $_POST
        if(isset($_POST['titre']) && isset($_POST['description']) && isset($_GET['id'])) {
            $id_projet = intval($_GET['id']);
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $id_utilisateur = intval($_SESSION['user_id']);
            // appeler fonction de ProjetDB
            $isOk = ProjetDB::update($id_projet, $titre, $description, $id_utilisateur);
        }
        // rediriger sur la page home
        Librairie::redirect('index.php', ['method' => 'index']);

    }

    public function insert() {
        // tester et recuperer les variables $_POST
        if(isset($_POST['titre']) && isset($_POST['description'])) {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $id_utilisateur = intval($_SESSION['user_id']);
            //echo 'titre : ' . $titre . '<br />';
            //echo 'description : ' . $description . '<br />';
            //echo 'id_utilisateur : ' . $id_utilisateur . '<br />';
            // appeler fonction de ProjetDB
            $isOk = ProjetDB::insert($titre, $description, $id_utilisateur);

        }
        // rediriger sur la page home *************************************
        Librairie::redirect('index.php', ['method' => 'index']);
    }
}
