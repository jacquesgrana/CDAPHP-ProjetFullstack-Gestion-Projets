<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Participer;
use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Kernel\DataBase;

class ParticiperDB {
    public static $tableName = 'participer';

    public static function insert($id_projet, $id_utilisateur, $id_tache) {
        $sql = "INSERT INTO " . self::$tableName . 
        " (id_projet, id_utilisateur, id_tache)" . 
        " VALUES ($id_projet, $id_utilisateur, $id_tache)";
        //echo 'sql' . $sql . '<br />';
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }
}
?>