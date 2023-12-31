<?php

namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Utils\ProjetDB;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;

/**
 * Contrôleur de la page home. Gère les requêtes de déconnexion et 
 * de suppression d'un projet.
 */
class Home extends AbstractController
{

    /**
     * TODO Ajouter affichage des taches de l'user
     */

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        // TODO recuperer le nom et le prenom du directeur
        if (Securite::isConnected()) {
            $id = $_SESSION['user_id'];
            $projetsDirected = ProjetDB::getByDirectorUserId($id);
            $projetsParticip = ProjetDB::getByParticipation($id);
            
        }
        $view = new View();
            $view->setHead('head.html')
                ->setHeader('header.php')
                ->setMain('home.php')
                ->setFooter('footer.html');
            $view->render([
                'flash' => $this->getFlashMessage(),
                'titlePage' => 'Page Accueil',
                'windowName' => 'Gestion de Projets - Accueil',
                'projetsDirected' => $projetsDirected ?? [],
                'projetsParticip' => $projetsParticip ?? [],
                'token' => Securite::getToken(),
                'isConnected' => Securite::isConnected()
            ]);
    }

    // TODO mettre ailleurs -> Securite?
    /**
     * Fonction qui demande la déconnexion.
     */
    public function disconnect()
    {
        Securite::disconnect();
        Librairie::redirect('index.php', ['page' => 'Home', 'method' => 'index']);
    }

    /**
     * Fonction qui demande la suppression d'un projet selon son id.
     */
    public function deleteProjet()
    {
        if (isset($_GET['id']) 
        && Securite::isTokenOk() 
        && Securite::isConnected()) {
            $id_projet = intVal($_GET['id']);
            if (Librairie::isProjetUtilisateurDirLegit($id_projet, intval($_SESSION['user_id']))) {
                $isOk = ProjetDB::deleteProjet($id_projet);
            echo (($isOk) ?  '<script>alert("Suppression du projet effectuée");</script>' : '<script>alert("Suppression du projet non effectuée");</script>');
            Librairie::redirect('index.php', ['page' => 'Home', 'method' => 'index']);
            }
            else {
                Librairie::redirectErrorPage('Suppression interdite : Données requête incohérentes');  
            }
        }
        if(!Securite::isTokenOk()) Librairie::redirectErrorPage('Suppression interdite : Problème de Token');
    }
}
