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
class Tache extends AbstractController
{
    private string $titlePage = 'Page d\'une tâche';
    private string $mode = 'view';
    private TacheObj $tache;
    private array $statuts;
    private array $priorites;
    private array $utilisateurs;
    private $getProUrl;

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        $this->statuts = StatutDB::getAll();
        $this->priorites = PrioriteDB::getAll();
        $this->utilisateurs = UtilisateurDB::getAll();
        $this->getProUrl = Librairie::getProjetUrl();
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
            'getProUrl' => $this->getProUrl ?? null,
            'token' => Securite::getToken(),
            'isConnected' => Securite::isConnected()
        ]);
    }

    /**
     * Fonction qui demande l'affichage de la page en mode edit/modifier.
     */
    public function edit()
    {
        if (Securite::isConnected() && Securite::isTokenOk()) {
            if (isset($_GET['id'])) {
                $id_tache = $_GET['id'];
                if (Librairie::isTacheUtilisateurDirLegit($id_tache, $_SESSION['user_id'])) {
                    $this->tache = TacheDB::getById($id_tache);
                } else {
                    Librairie::redirectErrorPage('Edition interdite : Données requête incohérentes');
                }
            }
            $this->mode = 'edit';
            $this->titlePage = 'Page d\'édition d\'une tâche';
            $this->index();
        } else {
            echo '<script>alert("Token et/ou Connexion incorrects");</script>';
        }
        if (!Securite::isConnected()) Librairie::redirectErrorPage('Edition interdite : Problème de Connexion');
        if (!Securite::isTokenOk()) Librairie::redirectErrorPage('Edition interdite : Problème de Token');
    }

    /**
     * Fonction qui demande l'affichage de la page en mode view/consulter.
     */
    public function view()
    {
        if (Securite::isConnected() && Securite::isTokenOk()) {
            if (isset($_GET['id'])) {
                $id_tache = $_GET['id'];
                if (
                    Librairie::isTacheUtilisateurDirLegit($id_tache, $_SESSION['user_id']) ||
                    Librairie::isTacheUtilisateurPartLegit($id_tache, $_SESSION['user_id'])
                ) {
                    $this->tache = TacheDB::getById($id_tache);
                } else {
                    Librairie::redirectErrorPage('Vue interdite : Données requête incohérentes');
                }
            }
            $this->mode = 'view';
            $this->titlePage = 'Page de consultation d\'une tâche';
            $this->index();
        }
        if (!Securite::isConnected()) Librairie::redirectErrorPage('Vue interdite : Problème de Connexion');
        if (!Securite::isTokenOk()) Librairie::redirectErrorPage('Vue interdite : Problème de Token');
    }

    /**
     * Fonction qui demande l'affichage de la page en mode create/créer.
     */
    public function create()
    {
        if (Securite::isConnected() && Securite::isTokenOk()) {
            $this->mode = 'create';
            $this->titlePage = 'Page de création d\'une tâche';
            $this->index();
        } else {
            echo '<script>alert("Token incorrect");</script>';
        }
        if (!Securite::isConnected()) Librairie::redirectErrorPage('Création interdite : Problème de Connexion');
        if (!Securite::isTokenOk()) Librairie::redirectErrorPage('Création interdite : Problème de Token');
    }

    /**
     * Fonction qui gère la requête de demande de modification 
     * d'une tâche selon son id.
     * Demande une requête sur la table participer pour la mettre à jour.
     */
    public function update()
    {
        if (
            isset($_POST['nom']) && isset($_POST['description'])
            && isset($_POST['utilisateur']) && isset($_POST['statut'])
            && isset($_POST['priorite']) && isset($_GET['id'])
            && Securite::isConnected() && Securite::isTokenOk()
        ) {
            $id_tache = $_GET['id'];
            $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
            $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
            $id_utilisateur = intval($_POST['utilisateur']);
            $id_statut = intval($_POST['statut']);
            $id_priorite = intval($_POST['priorite']);
            $id_projet = intval($_SESSION['id_projet']);
            if (Librairie::isTacheUtilisateurDirLegit($id_tache, intval($_SESSION['user_id']))) {
                $isOk = TacheDB::updateTache($id_tache, $nom, $description, $id_utilisateur, $id_statut, $id_priorite, $id_projet);
                $isOkPart = ParticiperDB::updateIdUtilByIdTache($id_tache, $id_utilisateur);
                echo (($isOk) ?  '<script>alert("Modification de la taĉhe effectuée");</script>' : '<script>alert("Modification de la taĉhe non effectuée");</script>');
                echo (($isOkPart) ?  '<script>alert("Modification de la participation effectuée");</script>' : '<script>alert("Modification de la participation non effectuée");</script>');
            } else {
                Librairie::redirectErrorPage('Modification interdite : Données requête incohérentes');
            }
        }
        if (!Securite::isConnected()) Librairie::redirectErrorPage('Modification interdite : Problème de Connexion');
        if (!Securite::isTokenOk()) {
            Librairie::redirectErrorPage('Modification interdite : Problème de Token');
        }
        Librairie::returnToProjet();
    }

    /**
     * Fonction qui gère la demande de requête d'insertion d'une 
     * nouvelle tâche.
     * Demande une requête sur la table participer pour la mettre à jour.
     */
    public function insert()
    {
        if (
            isset($_POST['nom']) && isset($_POST['description'])
            && isset($_POST['utilisateur']) && isset($_POST['statut'])
            && isset($_POST['priorite']) && Securite::isConnected()
            && Securite::isTokenOk()
        ) {
            $nom = htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');
            $description = htmlentities($_POST['description'], ENT_QUOTES, 'UTF-8');
            $utilisateur = intval($_POST['utilisateur']);
            $statut = intval($_POST['statut']);
            $priorite = intval($_POST['priorite']);
            $projet = intval($_SESSION['id_projet']);
            $idTache = TacheDB::insertTache($nom, $description, $utilisateur, $statut, $priorite, $projet);
            if ($idTache !== false) {
                echo '<script>alert("Ajout de la tâche effectué");</script>';
                $isOkPart = ParticiperDB::insertParticiper($projet, $utilisateur, $idTache);
                echo ($isOkPart ? '<script>alert("Ajout de la participation effectué");</script>' : '');
            } else {
                echo '<script>alert("Ajout de la tâche et de participation non effectué");</script>';
            }
            if (!Securite::isConnected()) Librairie::redirectErrorPage('Insertion interdite : Problème de Connexion');
            if (!Securite::isTokenOk()) {
                Librairie::redirectErrorPage('Insertion interdite : Problème de Token');
            } 
            Librairie::returnToProjet();
        }
    }
}
