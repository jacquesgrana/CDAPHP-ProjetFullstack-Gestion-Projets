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
            $id_utilisateur = $_GET['id'];
            if (Librairie::isUtilisateurLegit($id_utilisateur, $_SESSION['user_id'])) {
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
            } else {
                Librairie::redirectErrorPage('Vue interdite : Données requête incohérentes');
            }
        }
        if(!Securite::isConnected()) Librairie::redirectErrorPage('Vue interdite : Problème de Connexion');
        if (!Securite::isTokenOk()) {
            Librairie::redirectErrorPage('Vue interdite : Problème de Token');
        }
    }
}
