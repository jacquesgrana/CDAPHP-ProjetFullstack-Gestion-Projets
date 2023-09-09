<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Utils\ProjetDB;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;


class Home extends AbstractController{

    /**
     * TODO Ajouter affichage des taches de l'user
     */
    public function index()
    {
        // TODO recuperer le nom et le prenom du directeur
        if (Securite::isConnected()) {
            $id = $_SESSION['user_id'];
            //echo 'id : ' . $id . '<br />';
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
            'isConnected' => Securite::isConnected()
        ]);
    }

    // TODO mettre ailleurs -> Securite?
    public function disconnect() {
        //echo 'deco';
        Securite::disconnect();
        Librairie::redirect('index.php', ['page' => 'Home', 'method' => 'index']);
        //self::index();
    }

public function deleteProjet() {
        // recuperer l'id
        if(isset($_GET['id'])) {
            $id_projet = intVal($_GET['id']);
            // appeler fonction de TacheDB pour supprimer la tache
            $isOk = ProjetDB::delete($id_projet);
            // selon retour afficher message
            echo (($isOk) ?  '<script>alert("Suppression du projet effectuée");</script>' : '<script>alert("Suppression du projet non effectuée");</script>');
            
            Librairie::redirect('index.php', ['page' => 'Home', 'method' => 'index']);
        }
    }
}