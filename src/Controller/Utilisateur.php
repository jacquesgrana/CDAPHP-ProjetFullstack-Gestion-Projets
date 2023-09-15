<?php

namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;
use Jacques\ProjetPhpGestionProjets\Utils\UtilisateurDB;

/**
 * Contrôleur de la page utilisateur. Gère différentes requêtes.
 */
class Utilisateur extends AbstractController
{
    private string $titlePage = 'Page d\'un utilisateur';
    private $utilisateur;
    private $getProUrl;

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        if (isset($_GET['id']) && Securite::isConnected() && Securite::isTokenOk()) {
            //echo '$_GET["token"] : ' . $_GET["token"] . '<br />';
            //echo 'Securite::getToken() : ' . Securite::getToken() . '<br />';
            //echo 'Securite::isTokenOk() : ' . Securite::isTokenOk() . '<br />';
            $id_utilisateur = $_GET['id'];
            $this->utilisateur = UtilisateurDB::getById($id_utilisateur);
            $this->getProUrl = Librairie::getProjetUrl();
            $view = new View();
            $view->setHead('head.html')
                ->setHeader('header.php')
                ->setMain('utilisateur.php')
                ->setFooter('footer.html');
            $view->render([
                'flash' => $this->getFlashMessage(),
                'titlePage' => $this->titlePage,
                'windowName' => 'Gestion de Projets - Utilisateur',
                'utilisateur' => $this->utilisateur ?? null,
                'getProUrl' => $this->getProUrl ?? null,
                'token' => Securite::getToken(),
                'isConnected' => Securite::isConnected()
            ]);
        }
        /*
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.php')
        ->setMain('utilisateur.php')
        ->setFooter('footer.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => $this->titlePage,
            'windowName' => 'Gestion de Projets - Utilisateur',
            'utilisateur' => $this->utilisateur ?? null,
            'getProUrl' => $this->getProUrl ?? null,
            'token' => Securite::getToken(),
            'isConnected' => Securite::isConnected()
        ]);*/
    }
}
