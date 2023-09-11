<?php

namespace Jacques\ProjetPhpGestionProjets\Kernel;

use PDO;
use PDOException;

use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Configuration\Config;


/**
 * Classe chargée d'utiliser PDO.
 * Utilise un design singleton pour $intance.
 */
class DataBase extends PDO{

    private static $instance = null;

    private function __construct()
    {
        $dsn = 'mysql:dbname=' . Config::DBNAME . ';host=' . CONFIG::DBHOST;

        try {
            parent::__construct($dsn, CONFIG::DBUSER, CONFIG::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $e = sprintf("[%s] : %s ligne %s", $e->getMessage(), $e->getFile(), $e->getLine()) . PHP_EOL;
            echo 'Oups !!! Une erreur est survenue';
            die();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public static function execute($sql, $classname)
    {
        $pdostatement = DataBase::getInstance()->query($sql);
        return $pdostatement->fetchAll(PDO::FETCH_CLASS, $classname);
    }
}
?>