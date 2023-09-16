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
        //$toReturn = $result->id_utilisateur;
        
    }

    /*
    public static function getIdUtilisateurByTacheId(int $id_tache): int {
        $sql = "SELECT u.id_utilisateur 
            FROM utilisateur u , participer p , tache t 
            WHERE u.id_utilisateur = p.id_utilisateur 
            AND p.id_tache = t.id_tache 
            AND t.id_tache = " . $id_tache;
            $db = DataBase::getInstance();
            $stmt = $db->prepare($sql);
            $result = intval($stmt->execute());
            echo '$return : ' . $result; 
            echo '$id_tache : ' . $id_tache; 
            var_dump($result);
            return $result;
    }*/
}
?>