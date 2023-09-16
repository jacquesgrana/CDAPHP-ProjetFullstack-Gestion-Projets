<?php

namespace Jacques\ProjetPhpGestionProjets\Utils;

use Jacques\ProjetPhpGestionProjets\Kernel\Securite;

class Librairie
{

    /**
     * Fonction qui redirige vers $url avec des paramètres dans la query string.
     * Utilise du js pour ne pas utiliser la fonction 'header' de php.
     * @param string $url : destination de la redirection.
     * @param array $queryParameters : tableau associatif contenant les paramètres 
     * de la query string.
     */
    public static function redirect($url, $queryParameters = [])
    {
        $queryString = http_build_query($queryParameters);
        if (!empty($queryString)) {
            $url .= '?' . $queryString;
        }
        echo '<script type="text/javascript"> window.location="' . $url . '";</script>';
    }

    /**
     * Fonction qui redirige vers la page du projet avec 
     * la bonne querystring. Utilise des variables de session.
     */
    public static function returnToProjet()
    {
        // revenir a la page du projet en respectant le mode et l'id du projet (faire fonction pour construire l'url)
        $id_projet = $_SESSION['id_projet'];
        $method = $_SESSION['mode_projet'];
        $tabParams = ['page' => 'Projet', 
        'method' => $method, 
        'id' => $id_projet, 
        'token' => Securite::getToken()];
        // appeler fonction de la librairie de redirection js
        self::redirect('index.php', $tabParams);
    }

    /**
     * Fonction qui renvoi l'url du projet en cours en fonction
     * de variables de sessions.
     * @return string $url
     */
    public static function getProjetUrl()
    {
        $url = '/index.php?page=Projet&method=create';
        if (isset($_SESSION['id_projet']) && isset($_SESSION['mode_projet'])) {
            if ($_SESSION['mode_projet'] === 'edit') {
                $url = "/index.php?page=Projet&method=edit&id=" . $_SESSION['id_projet'] . "&token=" . Securite::getToken();
            } elseif ($_SESSION['mode_projet'] === 'view') {
                $url = "/index.php?page=Projet&method=view&id=" . $_SESSION['id_projet'] . "&token=" . Securite::getToken();
            }
        }
        return $url;
    }

    public static function redirectErrorPage($comment) {
        $_SESSION['error_comment'] = $comment;
        self::redirect('index.php', ['page' => 'Erreur', 'method' => 'index']);
    }

    public static function isTacheUtilisateurDirLegit(int $id_tache, int $id_utilisateur): bool
    {
        //echo 'is legit : ' . $id_utilisateur === ParticiperDB::getIdUtilisateurByTacheId($id_tache);
        return $id_utilisateur === TacheDB::getUtilisateurDirIdByTacheId($id_tache);
        //return false;
    }

    public static function isProjetUtilisateurDirLegit(int $id_projet, int $id_utilisateur): bool
    {
        return $id_utilisateur === ProjetDB::getUtilisateurIdByProjetId($id_projet);
    }

    public static function isProjetUtilisateurPartLegit($id_projet, $id_utilisateur): bool {
        $ids = ParticiperDB::getUtilisateurIdByProjetId($id_projet);
        //var_dump($ids);
        foreach($ids as $id) {
            if($id === $id_utilisateur) {
                return true;
            }
        }
        return false;
    }
}
