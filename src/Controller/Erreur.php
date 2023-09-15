<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;

/**
 * Contrôleur de la page erreur. Affiche un commentaire sur l'erreur.
 */
class Erreur extends AbstractController { 

    private string $comment = '';

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        if (isset($_SESSION['error_comment'])) {
            $this->comment = $_SESSION['error_comment'];
        }
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.php')
        ->setMain('erreur.php')
        ->setFooter('footer.html');

        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page Erreur',
            'windowName' => 'Gestion de Projets - Erreur',
            'comment' => $this->comment,
            'isConnected' => Securite::isConnected()
        ]);
    }
}
?>