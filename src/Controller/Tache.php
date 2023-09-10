<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\TacheDB;
use Jacques\ProjetPhpGestionProjets\Entity\Tache as TacheObj;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;
use Jacques\ProjetPhpGestionProjets\Utils\ParticiperDB;
use Jacques\ProjetPhpGestionProjets\Utils\UtilisateurDB;
use Jacques\ProjetPhpGestionProjets\Utils\StatutDB;
use Jacques\ProjetPhpGestionProjets\Utils\PrioriteDB;

/**
 * Contrôleur de la page tache. Gère différentes requêtes.
 */
class Tache extends AbstractController {
    private string $titlePage = 'Page d\'une tâche';
    private string $mode = 'view';
    private TacheObj $tache;
    private array $statuts;
    private array $priorites;
    private array $utilisateurs;

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        $this->statuts = StatutDB::getAll();
        $this->priorites = PrioriteDB::getAll();
        $this->utilisateurs = UtilisateurDB::getAll();
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.php')
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

    /**
     * Fonction qui demande l'affichage de la page en mode edit/modifier.
     */
    public function edit() {
        if (Securite::isConnected()) {
            if(isset($_GET['id'])) {
                $id_tache = $_GET['id'];
                $this->tache = TacheDB::getById($id_tache);
            }
        }
        $this->mode = 'edit';
        $this->titlePage = 'Page d\'édition d\'une tâche';
        $this->index();
    }

    /**
     * Fonction qui demande l'affichage de la page en mode view/consulter.
     */
    public function view() {
        if (Securite::isConnected()) {
            if(isset($_GET['id'])) {
                $id_tache = $_GET['id'];
                $this->tache = TacheDB::getById($id_tache);
            }
        }
        $this->mode = 'view';
        $this->titlePage = 'Page de consultation d\'une tâche';
        $this->index();
    }

    /**
     * Fonction qui demande l'affichage de la page en mode create/créer.
     */
    public function create() {
        $this->mode = 'create';
        $this->titlePage = 'Page de création d\'une tâche';
        $this->index();
    }

    /**
     * Fonction qui gère la requête de modification d'une tâche selon 
     * son id.
     * Demande une requête sur la table participer pour la mettre à jour.
     */
    public function update() {
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

            $isOk = TacheDB::updateTache($id_tache, $nom, $description, $id_utilisateur, $id_statut, $id_priorite, $id_projet);

            $isOkPart = ParticiperDB::updateIdUtilByIdTache($id_tache, $id_utilisateur);

            echo (($isOk) ?  '<script>alert("Modification de la taĉhe effectuée");</script>' : '<script>alert("Modification de la taĉhe non effectuée");</script>');
            echo (($isOkPart) ?  '<script>alert("Modification de la participation effectuée");</script>' : '<script>alert("Modification de la participation non effectuée");</script>');

            Librairie::returnToProjet();
        }
    }

    /**
     * Fonction qui gère la requête d'insertion d'une nouvelle tâche.
     * Demande une requête sur la table participer pour la mettre à jour.
     */
    public function insert() {
        if (isset($_POST['nom']) && isset($_POST['description']) 
        && isset($_POST['utilisateur']) && isset($_POST['statut']) 
        && isset($_POST['priorite'])) {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $utilisateur = intval($_POST['utilisateur']);
            $statut = intval($_POST['statut']);
            $priorite = intval($_POST['priorite']);
            $projet = intval($_SESSION['id_projet']);
            $idTache = TacheDB::insertTache($nom, $description, $utilisateur, $statut, $priorite, $projet);
            if ($idTache !== false) { 
                echo '<script>alert("Ajout de la tâche effectué");</script>';
                $isOkPart = ParticiperDB::insertParticiper($projet, $utilisateur, $idTache);
                echo ($isOkPart ? '<script>alert("Ajout de la participation effectué");</script>' : '');
            } 
            else { 
                echo '<script>alert("Ajout de la tâche et de participation non effectué");</script>';
            }
            Librairie::returnToProjet();
        }
    }
}
