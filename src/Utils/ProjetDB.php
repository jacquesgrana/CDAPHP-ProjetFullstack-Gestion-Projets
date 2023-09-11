<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Projet;
use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Kernel\DataBase;
use Jacques\ProjetPhpGestionProjets\Abstract\Creators\ProjetCreator;

/**
 * Classe chargée d'exécuter des requêtes sur la table projet.
 */
class ProjetDB extends Model {
    public static $tableName = 'projet';
    public static $tableUtilName = 'utilisateur';
    public static $tablePartname = 'participer';

    // TODO faire requête préparée
    /**
     * Fonction qui renvoie les projets selon l'id du directeur du projet.
     * @param int $id_utilisateur : id du directeur
     * @return array : tableau de Projet
     */
    public static function getByDirectorUserId(int $id_utilisateur): array {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id_utilisateur=$id_utilisateur";
        $projetsGeneric = Model::Execute($sql);
        $projetsObj = [];
        foreach($projetsGeneric as $pGen) {
            $projetsObj[] = ProjetCreator::makeObjectFromGeneric($pGen);
        }
        return $projetsObj;
    }

    /**
     * Fonction qui renvoie les projets auxquels participe un utilisateur
     * selon son id.
     * @param int $id_utilisateur : id de l'utilisateur participant
     * @return array : tableau d'objets génériques
     */
    public static function getByParticipation(int $id_utilisateur): array {

        $sql = "SELECT pr.id_projet, pr.titre, pr.description, pr.id_utilisateur 
        FROM projet pr, participer pa, utilisateur u  
        WHERE pr.id_projet = pa.id_projet 
        AND pa.id_utilisateur = u.id_utilisateur 
        AND u.id_utilisateur=$id_utilisateur
        ";
        $projetsGeneric = Model::Execute($sql);
        $projetsObj = [];
        foreach($projetsGeneric as $pGen) {
            $projetsObj[] = ProjetCreator::makeObjectFromGeneric($pGen);
        }
        return $projetsObj;
    }

    /**
     * Fonction qui renvoie un projet selon son id.
     * @param int $id : id du projet
     */
    public static function getById(int $id)
    {
        $sql = "SELECT * FROM " . static::$tableName . " where id_projet=$id";
        $result =  Model::Execute($sql);
        return $result[0];
    }

    /**
     * Fonction qui insère un nouveau tuple.
     * @param : propriétés du nouveau tuple.
     */
    public static function insertProjet(string $titre, string $description, int $id_utilisateur) {
        $sql = "INSERT INTO " . self::$tableName .
            " (titre, description, id_utilisateur)" . 
            " VALUES ('$titre', '$description', $id_utilisateur)";
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    /**
     * Fonction qui modifie un tuple selon son id.
     * @param int $id_projet : id du tuple à modifier
     * @param : le reste, propriétés du tuple à modifier.
     */
    public static function updateProjet($id_projet, $titre, $description, $id_utilisateur) {
        $sql = "UPDATE " . self::$tableName .
        " SET titre = '$titre', description = '$description', id_utilisateur = $id_utilisateur" .
        " WHERE id_projet=" . $id_projet;
        //echo 'sql : ' . $sql . '<br />';
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    /**
     * Fonction qui supprime un tuple selon son id.
     * @param int $id_projet : id du tuple à supprimer
     */
    public static function deleteProjet($id_projet) {
        $sql = "DELETE FROM " . self::$tableName . " WHERE id_projet=" . $id_projet;
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    /*
    // TODO mettre dans une classe abstraite avec boucle sur l'objet generique
    public static function makeObjectFromGeneric($generic): Projet {
        $pObj = new Projet();
        $pObj->setDescription($generic->description);
        $pObj->setId_projet($generic->id_projet);
        $pObj->setId_utilisateur($generic->id_utilisateur);
        $pObj->setTitre($generic->titre);
        return $pObj;
    }*/
}
?>