<?php

namespace Jacques\ProjetPhpGestionProjets\Kernel;

use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;
use Jacques\ProjetPhpGestionProjets\Utils\UtilisateurDB;

class Securite
{

    public static function isConnected(): bool {
        if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
            return true;
        }
        return false;
    }

    /**
    * Déconnecte l'utilisateur
    *
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
                    //header('location: http://' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/index.php?page=accueil');

                    //echo 'login : ok';
                }
                else {
                    $_SESSION['user'] = false;
                    //echo 'login : ko';
                }
            }
        } 
        elseif (isset($_SESSION['user']) && $_SESSION['user'] === true) {
            //header('location: http://' . $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/index.php?page=accueil');
            echo 'login : déjà ok';
        } 
        else {
            $_SESSION['user'] = false;
            session_destroy();
            echo 'login : ko';
        }
    }

    /**
     * Fonction (ajoutée) qui met dans des variables de session les infos de l'user qui vient de se logger.
     */

    // ************************************************
    // TODO faire fonction pour recuperer l'user par son email et utiliser les getters et setters
    public static function setUserSessionInfos(string $email): void
    {
        /*
        $users = self::getUsersToFilter();
        foreach ($users as $u) {
            if ($u["email"] === $email) {
                $user = $u;
            }
        }*/
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
    // ******************************************************
    // Améliorer
    public static function isUserExistsAndValidated(string $email, string $pwd): bool
    {
        $users = Utilisateur::getAll();
        /*
    if (is_array($users) && array_key_exists($email, $users) &&  password_verify($pwd, $users[$email])) {
        //echo "pw ok";
        return true;
    }
    //echo "pw ko";
    return false;*/
        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user->getEmail() === $email) {
                    return password_verify($pwd, $user->getMdp());
                    /*
                if(password_verify($pwd, $user->getMdp())) {
                    return true;
                }*/
                }
            }
        }
        return false;
    }
}
