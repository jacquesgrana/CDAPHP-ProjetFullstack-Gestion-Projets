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


    /**
     * Fonction qui renvoie un tableau contenant les id des utilisateurs
     * participant à un projet selon l'id du projet.
     */
    public static function getUtilisateurIdByProjetId(int $id_projet): array {
        $sql = "SELECT DISTINCT pa.id_utilisateur 
        FROM participer pa 
        WHERE pa.id_projet = $id_projet";
        $result = Model::Execute($sql);
        if(count($result) > 0) {
            $toReturn = [];
            foreach($result as $id) {
                $toReturn[] = intval($id->id_utilisateur);
            }
            return $toReturn;
        }
        else {
            return [];
        }
    }

    /**
     * Fonction qui renvoie un tableau contenant les id des directeur
     * des projets auquel participe l'utilisateur selon son id.
     */
    public static function getUtilisateurDirIdByUtilisateurId($id_utilisateur): array {
        $sql = "SELECT DISTINCT pr.id_utilisateur 
        FROM participer pa, projet pr
        WHERE pa.id_projet = pr.id_projet 
        AND pa.id_utilisateur = $id_utilisateur";
        $result = Model::Execute($sql);
        if(count($result) > 0) {
            $toReturn = [];
            foreach($result as $id) {
                $toReturn[] = intval($id->id_utilisateur);
            }
            return $toReturn;
        }
        else {
            return [];
        }
    }

    /**
     * Fonction qui renvoi un tableau contenant les id des utilisateurs
     * présents dans les mêmes projets que l'utilisateur.
     */
    public static function getUtilisateurPartProjetIdByUtilisateurId(int $id_utilisateur): array {
        $sql = "SELECT pa.id_utilisateur
        FROM participer pa, projet pr
        WHERE pa.id_projet = pr.id_projet 
        AND pa.id_projet IN (SELECT pro.id_projet FROM projet pro, participer par WHERE pro.id_projet = par.id_projet AND par.id_utilisateur = $id_utilisateur)";
        $result = Model::Execute($sql);
        if(count($result) > 0) {
            $toReturn = [];
            foreach($result as $id) {
                $toReturn[] = intval($id->id_utilisateur);
            }
            return $toReturn;
        }
        else {
            return [];
        }
    }

    /**
     * Fonction qui renvoie l'id de l'utilisateur participant
     * à une tâche selon son id.
     */
    public static function getUtilisateurPartIdByTacheId(int $id_tache): array {
        $sql = "SELECT DISTINCT pa.id_utilisateur 
        FROM participer pa, projet pr
        WHERE pa.id_projet IN (SELECT pro.id_projet FROM projet pro, tache t  WHERE t.id_projet = pro.id_projet AND t.id_tache = $id_tache)";
        $result = Model::Execute($sql);
        if(count($result) > 0) {
            $toReturn = [];
            foreach($result as $id) {
                $toReturn[] = intval($id->id_utilisateur);
            }
            return $toReturn;
        }
        else {
            return [];
        }
    }
}
?>