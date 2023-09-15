<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\TacheDB;
use Jacques\ProjetPhpGestionProjets\Entity\Projet as ProjetObj;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;
use Jacques\ProjetPhpGestionProjets\Utils\ProjetDB;
use Jacques\ProjetPhpGestionProjets\Utils\UtilisateurDB;
use Jacques\ProjetPhpGestionProjets\Abstract\Creators\ProjetCreator;

/**
 * Contrôleur de la page projet. Gère différentes requêtes.
 */
class Projet extends AbstractController {
    private string $mode;
    private ProjetObj $projet; 
    private array $tachesAll;
    private string $titlePage = 'Page d\'un projet';
    private ?array $utilisateurs;

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        $this->utilisateurs = UtilisateurDB::getAll();
        if($this->mode !== 'create') {
            $this->tachesAll = TacheDB::getAllByProjetId($this->projet->getId_projet());
        }
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.php')
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
            'token' => Securite::getToken(),
            'isConnected' => Securite::isConnected()
        ]);
    }

    /**
     * Fonction qui demande l'affichage de la page en mode edit/modifier.
     */
    public function edit() {
        // TODO ajouter verification de l'user id si matche avec $id_projet
        if (Securite::isConnected() && Securite::isTokenOk()) {
            if(isset($_GET['id'])) {
                $id_projet = $_GET['id'];
                if(Librairie::isProjetUtilisateurLegit($id_projet, $_SESSION['user_id'])) {
                    $tempObj= ProjetDB::getById($id_projet);
                    $this->projet = ProjetCreator::makeObjectFromGeneric($tempObj);
                    $_SESSION['id_projet'] = $id_projet;
                }
                else {
                    Librairie::redirectErrorPage('Edition interdite : Données incohérentes');
                }
                
            } 
           $this->mode = 'edit';
            $_SESSION['mode_projet'] = $this->mode;
            $this->titlePage = 'Page d\'édition d\'un projet';
            $this->index();            
        }
        else {
            echo '<script>alert("Token et/ou Connexion incorrects");</script>';
        }
        
        if(!Securite::isTokenOk()) Librairie::redirectErrorPage('Edition interdite : Problème de Token');
        
    }

    /**
     * Fonction qui demande l'affichage de la page en mode view/consulter.
     */
    public function view() {
        if (Securite::isConnected() && Securite::isTokenOk()) {
            if(isset($_GET['id'])) {
                $id_projet = $_GET['id'];
                
                    $tempObj= ProjetDB::getById($id_projet);
                    $this->projet = ProjetCreator::makeObjectFromGeneric($tempObj);
                    $_SESSION['id_projet'] = $id_projet;
                
            }
            $this->mode = 'view';
            $_SESSION['mode_projet'] = $this->mode;
            $this->titlePage = 'Page de consultation d\'un projet';
            $this->index();            
        }
        else {
            echo '<script>alert("Token et/ou Connexion incorrects");</script>';
        }
        if(!Securite::isTokenOk()) Librairie::redirectErrorPage('Vue interdite : Problème de Token');
        
    }

    /**
     * Fonction qui demande l'affichage de la page en mode create/créer.
     */
    public function create() {
        //$this->projet = null;
        if(Securite::isTokenOk()) {
            $this->mode = 'create';
            $_SESSION['mode_projet'] = $this->mode;
            $this->titlePage = 'Page de création d\'un projet';
            $this->index();
        }
        else {
            echo '<script>alert("Token et/ou Connexion incorrects");</script>';
        }
        if(!Securite::isTokenOk()) Librairie::redirectErrorPage('Création interdite : Problème de Token');
    }

    /**
     * Fonction qui gère la requête de suppression d'une tâche selon 
     * son id.
     */
    public function deleteTache() {
        if(isset($_GET['id']) && Securite::isTokenOk()) {
            $id_tache = intVal($_GET['id']);
            if (Librairie::isTacheUtilisateurLegit($id_tache, intval($_SESSION['user_id']))) {
                $isOk = TacheDB::deleteTache($id_tache);
                echo (($isOk) ?  '<script>alert("Suppression de la taĉhe effectuée");</script>' : '<script>alert("Suppression de la taĉhe non effectuée");</script>');
            }
            else {
                Librairie::redirectErrorPage('Suppression interdite : Données incohérentes');  
            }
        }
        if(!Securite::isTokenOk()) {
            Librairie::redirectErrorPage('Suppression interdite : Problème de Token');
        }
        else {
            Librairie::returnToProjet();
        }
    }

    /**
     * Fonction qui gère la requête de modification d'un projet selon 
     * son id.
     */
    public function update() {
         // TODO modifier autoriser modification que si user possede le projet

        if(isset($_POST['titre']) && isset($_POST['description']) 
        && isset($_GET['id']) && Securite::isTokenOk()) {
            $id_projet = intval($_GET['id']);
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $id_utilisateur = intval($_SESSION['user_id']);
            if (Librairie::isProjetUtilisateurLegit($id_projet, intval($_SESSION['user_id']))) {
                $isOk = ProjetDB::updateProjet($id_projet, $titre, $description, $id_utilisateur);
                if($isOk) {
                    echo '<script>alert("Modification du projet effectuée");</script>';
                }
                else {
                    echo '<script>alert("Modification du projet non effectuée");</script>';
                }
            }
            else {
                Librairie::redirectErrorPage('Modification interdite : Données incohérentes');
            }
        }
        if(!Securite::isTokenOk()) {
            Librairie::redirectErrorPage('Modification interdite : Problème de Token');
        }
        else {
            Librairie::redirect('index.php', ['page' => 'Home', 'method' => 'index']);
        }
        
    }

    /**
     * Fonction qui gère la requête d'insertion d'un nouveau projet.
     */
    public function insert() {
        // tester et recuperer les variables $_POST
        if(isset($_POST['titre']) && isset($_POST['description'])
        && Securite::isTokenOk()) {
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $id_utilisateur = intval($_SESSION['user_id']);
            // appeler fonction de ProjetDB
            $isOk = ProjetDB::insertProjet($titre, $description, $id_utilisateur);
            if($isOk) {
                echo '<script>alert("Ajout du projet effectué");</script>';
            }
            else {
                echo '<script>alert("Ajout du projet non effectué");</script>';
            }
        }
        if(!Securite::isTokenOk()) {
            Librairie::redirectErrorPage('Insertion interdite : Problème de Token');
        }
        else {
            Librairie::redirect('index.php', ['page' => 'Home', 'method' => 'index']);
        }
        //Librairie::redirect('index.php', ['page' => 'Home', 'method' => 'index']);

    }
}
