<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\UtilisateurDB;

/**
 * Contrôleur de la page utilisateur. Gère différentes requêtes.
 */
class Utilisateur extends AbstractController {
    private string $titlePage = 'Page d\'un utilisateur';
    private $utilisateur;

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        if(isset($_GET['id']) && Securite::isConnected()) {
            $id_utilisateur = $_GET['id'];
            $this->utilisateur = UtilisateurDB::getById($id_utilisateur);
            //var_dump($this->utilisateur);
        
        }
        
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.php')
        ->setMain('utilisateur.php')
        ->setFooter('footer.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => $this->titlePage,
            'windowName' => 'Gestion de Projets - Tache',
            'utilisateur' => $this->utilisateur ?? null,
            'isConnected' => Securite::isConnected()
        ]);
    }
}
?>