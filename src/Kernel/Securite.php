<?php

namespace Jacques\ProjetPhpGestionProjets\Kernel;

use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;
use Jacques\ProjetPhpGestionProjets\Utils\UtilisateurDB;

/**
 * Classe chargée des connexions/déconnexions.
 */
class Securite
{

    /**
     * Fonction qui renvoie vrai si l'utilisateur est connecté, 
     * faux sinon.
     * @return bool vrai si connecté
     */
    public static function isConnected(): bool {
        if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
            return true;
        }
        return false;
    }

    /**
    * Fonction qui déconnecte l'utilisateur
    * @return void
    */
    public static function disconnect()
   {
       if (self::isConnected()) {
            $_SESSION['user'] === false;
           session_destroy();
       }
   }

    public static function connect()
    {
        // soit l'utilisateur vient de remplir le formulaire et on vérifie login/pw
        if (isset($_POST['connexion']) && $_POST['connexion'] === 'connect') {
            //session_destroy();
            if (isset($_POST['email']) && isset($_POST['mdp'])) {
                if (self::isUserExistsAndValidated($_POST['email'], $_POST['mdp']) === true) {
                    //session_start();
                    self::setUserSessionInfos($_POST['email']);
                    $_SESSION['user'] = true;
                }
                else {
                    $_SESSION['user'] = false;
                }
            }
        } 
        elseif (isset($_SESSION['user']) && $_SESSION['user'] === true) {
            //echo 'login : déjà ok';
        } 
        else {
            $_SESSION['user'] = false;
            session_destroy();
        }
    }

    /**
     * Fonction (ajoutée) qui met dans des variables de session les infos de l'user qui vient de se logger.
     */
    public static function setUserSessionInfos(string $email): void
    {
        $user = UtilisateurDB::getUserByEmail($email);
        $_SESSION['user_id'] = $user->getId_utilisateur();
        $_SESSION['user_firstname'] = $user->getPrenom();
        $_SESSION['user_lastname'] = $user->getNom();
        $_SESSION['user_email'] = $email;
    }

    /**
     * Cherche un utilisateur dans la bdd par son email
     * Renvoi vrai si l'email existe dans la bdd et que le
     * mdp associé matche avec $pwd
     * @param string $email email d'utilisateur
     * @param string $pwd mdp de l'utilisateur
     * @return void
     */
    public static function isUserExistsAndValidated(string $email, string $pwd): bool
    {
        $users = UtilisateurDB::getAll();
        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user->getEmail() === $email) {
                    return password_verify($pwd, $user->getMdp());
                }
            }
        }
        return false;
    }
}
