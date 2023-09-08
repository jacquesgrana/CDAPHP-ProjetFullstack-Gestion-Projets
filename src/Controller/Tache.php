<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\TacheDB;
use Jacques\ProjetPhpGestionProjets\Entity\Tache as TacheObj;
use Jacques\ProjetPhpGestionProjets\Entity\Statut;
use Jacques\ProjetPhpGestionProjets\Entity\Priorite;
use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;

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

    public function update() {
        // si changement d'id_utilisateur -> mettre ajour la table participer, faire requete avec id_tache et modifier id_utilisateur
        if (isset($_POST['nom']) && isset($_POST['description']) 
        && isset($_POST['utilisateur']) && isset($_POST['statut']) 
        && isset($_POST['priorite']) && isset($_GET['id'])) {
            $id_tache = $_GET['id'];
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $id_utilisateur = intval($_POST['utilisateur']);
            $id_statut = intval($_POST['statut']);
            $id_priorite = intval($_POST['priorite']);
            $id_projet = intval($_SESSION['id_projet']);

            /*
            echo 'id_tache : ' . $id_tache . '<br />';
            echo 'nom : ' . $nom . '<br />';
            echo 'description : ' . $description . '<br />';
            echo 'id_utilisateur : ' . $id_utilisateur . '<br />';
            echo 'id_statut : ' . $id_statut . '<br />';
            echo 'id_priorite : ' . $id_priorite . '<br />';
            echo 'id_projet : ' . $id_projet . '<br />';
            */

            $isOk = TacheDB::update($id_tache, $nom, $description, $id_utilisateur, $id_statut, $id_priorite, $id_projet);

            ($isOk) ? $this->setFlashMessage('Modification effectuée' , 'success') : $this->setFlashMessage('Modification non effectuée' , 'error');

            Librairie::returnToProjet();
        }
    }

    public function insert() {
        //echo 'methode insert';
            
        // tester et recuperer les variables post et get
        if (isset($_POST['nom']) && isset($_POST['description']) 
        && isset($_POST['utilisateur']) && isset($_POST['statut']) 
        && isset($_POST['priorite'])) {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $utilisateur = intval($_POST['utilisateur']);
            $statut = intval($_POST['statut']);
            $priorite = intval($_POST['priorite']);
            $projet = intval($_SESSION['id_projet']);
            
        // appeler fonction de TacheDB en lui passant les datas en parametre
            $isOk = TacheDB::insert($nom, $description, $utilisateur, $statut, $priorite, $projet);

            ($isOk) ? $this->setFlashMessage('Ajout effectué' , 'success') : $this->setFlashMessage('Ajout non effectué' , 'error');
            //echo (($isOk) ? 'Requete ok' : 'Requete ko');
        // selon retour creer des messages d'alertes
        
        // ********************************* IMPORTANT *************
        // faire ajout dans table participer avec id_utilisateur et id_projet et id_tache (faire fonction dans TacheDB)

            Librairie::returnToProjet();
        }
    }
    /*
    private static function returnToProjet() {
        // revenir a la page du projet en respectant le mode et l'id du projet (faire fonction pour construire l'url)
        $id_projet = $_SESSION['id_projet'];
        $method = $_SESSION['mode_projet'];
        $tabParams = ['page' => 'Projet', 'method' => $method, 'id' => $id_projet];
        // appeler fonction de la librairie de redirection js
        Librairie::redirect('index.php', $tabParams);
    }*/
}
