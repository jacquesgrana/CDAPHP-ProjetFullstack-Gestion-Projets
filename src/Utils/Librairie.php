<?php

namespace Jacques\ProjetPhpGestionProjets\Utils;

class Librairie
{

    /**
     * Fonction qui redirige vers $url avec des paramtres dans la query string.
     * Utilise du js pour moins utiliser la fonction 'header' de php.
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

    public static function returnToProjet()
    {
        // revenir a la page du projet en respectant le mode et l'id du projet (faire fonction pour construire l'url)
        $id_projet = $_SESSION['id_projet'];
        $method = $_SESSION['mode_projet'];
        $tabParams = ['page' => 'Projet', 'method' => $method, 'id' => $id_projet];
        // appeler fonction de la librairie de redirection js
        self::redirect('index.php', $tabParams);
    }

    public static function getProjetUrl()
    {
        $url = '/index.php?page=Projet&method=create';
        if (isset($_SESSION['id_projet']) && isset($_SESSION['mode_projet'])) {
            if ($_SESSION['mode_projet'] === 'edit') {
                $url = "/index.php?page=Projet&method=edit&id=" . $_SESSION['id_projet'];
            } elseif ($_SESSION['mode_projet'] === 'view') {
                $url = "/index.php?page=Projet&method=view&id=" . $_SESSION['id_projet'];
            }
        }
        return $url;
    }
}
