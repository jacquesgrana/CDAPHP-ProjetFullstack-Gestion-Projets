<?php
namespace Jacques\ProjetPhpGestionProjets\Configuration;

/**
 * Classe de configuration, contient les constantes de l'application.
 */
class Config {
    public const CONTROLLER = 'Jacques\ProjetPhpGestionProjets\Controller\\';
    public const VIEWS = 'Views/';
    public const TEMPLATES = 'Views/Templates/';
    //public const FORMS = 'Views/Form/';
    public const DBHOST = 'localhost';
    public const DBUSER = 'admin';
    public const DBPASS = 'admin';
    public const DBNAME = 'gestion_projet';

    // TODO a utiliser
    public const ENTITY_TO_VERIFY = 'Jacques\ProjetPhpGestionProjets\Entity\Utilisateur';
    public const USER_NAME_PROPERTY = 'email';
    public const USER_PASSWORD_PROPERTY = 'mdp';
}
?>