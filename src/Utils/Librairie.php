<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
class Librairie {

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

public static function returnToProjet() {
    // revenir a la page du projet en respectant le mode et l'id du projet (faire fonction pour construire l'url)
    $id_projet = $_SESSION['id_projet'];
    $method = $_SESSION['mode_projet'];
    $tabParams = ['page' => 'Projet', 'method' => $method, 'id' => $id_projet];
    // appeler fonction de la librairie de redirection js
    self::redirect('index.php', $tabParams);
}
}
