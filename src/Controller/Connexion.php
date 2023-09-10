<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;

/**
 * Contrôleur de la page connexion. Gère la requête de connexion, 
 * appelle la fonction connect().
 */
class Connexion extends AbstractController {

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        if (isset($_POST["email"]) && isset($_POST["mdp"])) {
            Securite::connect();
        }
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.php')
        ->setMain('connexion.php')
        ->setFooter('footer.html');

        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page Connexion',
            'windowName' => 'Gestion de Projets - Connexion',
            'isConnected' => Securite::isConnected()
        ]);
    }
}
?>