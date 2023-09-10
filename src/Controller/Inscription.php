<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;
use Jacques\ProjetPhpGestionProjets\Utils\UtilisateurDB;
use Jacques\ProjetPhpGestionProjets\Utils\Librairie;

/**
 * Contrôleur de la page inscription. Gère la requête création 
 * d'un, utilisateur.
 */
class Inscription extends AbstractController {

    /**
     * Fonction qui construit et demande l'affichage de la vue.
     */
    public function index()
    {
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.php')
        ->setMain('inscription.php')
        ->setFooter('footer.html');

        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page Inscription',
            'windowName' => 'Gestion de Projets - Inscription',
            //'comment' => $this->comment,
            'isConnected' => Securite::isConnected()
        ]);
    }

    /**
     * Fonction qui gère la création d'un utilisateur.
     */
    public function create() {
        // tester et recuperer les donnees du formulaire
        if(isset($_POST['nom']) 
        && isset($_POST['prenom'])
        && isset($_POST['mdp'])
        && isset($_POST['email'])
        && isset($_POST['connexion'])) {
            if($_POST['connexion'] === 'create') {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $mdp = $_POST['mdp'];
                $email = $_POST['email'];
                // hasher le mdp
                $hash = password_hash($mdp, PASSWORD_DEFAULT);
                // tester si l'email est deja dans la bdd (faire requete avec UtilisateurDB)
                if(!UtilisateurDB::isEmailIsInDB($email)) {
                    // ajouter en bdd avec fonction de UtilisateurDB
                    $isOk = UtilisateurDB::insertUtilisateur($nom, $prenom, $hash, $email);
                    echo (($isOk) ?  '<script>alert("Création de l\'utilisateur effectué");</script>' : '<script>alert("Création de l\'utilisateur non effectué");</script>');
                    // renvoyer sur la page de connexion
                    Librairie::redirect('index.php', ['page' => 'Connexion', 'method' => 'index']);
                }
                else {
                    // sinon renvoyer sur page d'incription, faire apparaitre une alerte si possible ('email déjà pris')
                    echo '<script>alert("Email déjà présent, choisissez en un autre");</script>';
                    Librairie::redirect('index.php', ['page' => 'Inscription', 'method' => 'index']);
                    
                }
            }
        }   
        $this->index();
    }
}
?>