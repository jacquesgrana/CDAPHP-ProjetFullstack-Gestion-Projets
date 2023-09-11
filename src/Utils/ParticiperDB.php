<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Kernel\DataBase;

/**
 * Classe chargée d'exécuter des requêtes sur la table participer.
 */
class ParticiperDB extends Model {
    public static $tableName = 'participer';

    /**
     * Fontion qui insère un tuple dans la table participer.
     */
    public static function insertParticiper($id_projet, $id_utilisateur, $id_tache) {
        $sql = "INSERT INTO " . self::$tableName . 
        " (id_projet, id_utilisateur, id_tache)" . 
        " VALUES ($id_projet, $id_utilisateur, $id_tache)";
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    /**
     * Fonction qui modifie un tuple dans la table participer selon
     * $id_tache, modifie seulement $id_utilisateur.
     */
    public static function updateIdUtilByIdTache($id_tache, $id_utilisateur) {
        $sql = "UPDATE " . self::$tableName .
            " SET id_utilisateur = $id_utilisateur" .
            " WHERE id_tache=" . $id_tache;
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }
}
?>