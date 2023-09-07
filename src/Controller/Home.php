<?php
namespace Jacques\ProjetPhpGestionProjets\Controller;

use Jacques\ProjetPhpGestionProjets\Kernel\View;
use Jacques\ProjetPhpGestionProjets\Kernel\AbstractController;
use Jacques\ProjetPhpGestionProjets\Utils\ProjetDB;
use Jacques\ProjetPhpGestionProjets\Kernel\Securite;


class Home extends AbstractController{

    public function index()
    {
        // TODO recuperer le nom et le prenom du directeur
        if (Securite::isConnected()) {
            $id = $_SESSION['user_id'];
            //echo 'id : ' . $id . '<br />';
            $projetsDirected = ProjetDB::getByDirectorUserId($id);
            $projetsParticip = ProjetDB::getByParticipation($id);
        }
        $view = new View();
        $view->setHead('head.html')
        ->setHeader('header.html')
        ->setMain('home.php')
        ->setFooter('footer.html');
        $view->render([
            'flash' => $this->getFlashMessage(),
            'titlePage' => 'Page Accueil',
            'windowName' => 'Gestion de Projets - Accueil',
            'projetsDirected' => $projetsDirected ?? [],
            'projetsParticip' => $projetsParticip ?? [],
            'isConnected' => Securite::isConnected()
        ]);
    }

    public function disconnect() {
        //echo 'deco';
        Securite::disconnect();
        self::redirect('index.php', ['page' => 'Home', 'method' => 'index']);
        //self::index();
    }

    /**
 * Fonction qui redirige vers $url avec des paramtres dans la query string.
 * Utilise du js pour moins utiliser la fonction 'header' de php.
 * @param string $url : destination de la redirection.
 * @param array $queryParameters : tableau associatif contenant les paramètres 
 * de la query string.
 */
public function redirect($url, $queryParameters = [])
{
    $queryString = http_build_query($queryParameters);
    if (!empty($queryString)) {
        $url .= '?' . $queryString;
    }
    echo '<script type="text/javascript"> window.location="' . $url . '";</script>';
}

}