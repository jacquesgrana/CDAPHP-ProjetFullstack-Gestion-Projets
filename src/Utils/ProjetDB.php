<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Projet;
use Jacques\ProjetPhpGestionProjets\Entity\Model;

class ProjetDB {
    public static $tableName = 'projet';
    public static $tableUtilName = 'utilisateur';
    public static $tablePartname = 'participer';

    // TODO faire requête préparée
    // TODO factory pour construire l'$projetsObj ?
    public static function getByDirectorUserId(int $id_utilisateur): array {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id_utilisateur=$id_utilisateur";
        $projetsGeneric = Model::Execute($sql);
        // TODO remplacer par un map
        $projetsObj = [];
        foreach($projetsGeneric as $pGen) {
            $projetsObj[] = self::makeObjectFromGeneric($pGen);
        }
        return $projetsObj;
    }

    public static function getByParticipation(int $id_utilisateur) {

        $sql = "SELECT pr.id_projet, pr.titre, pr.description, pr.id_utilisateur 
        FROM projet pr, participer pa, utilisateur u  
        WHERE pr.id_projet = pa.id_projet 
        AND pa.id_utlilisateur = u.id_utilisateur 
        AND u.id_utilisateur=$id_utilisateur
        ";
        // TODO factoriser
        $projetsGeneric = Model::Execute($sql);
        // TODO remplacer par un map
        $projetsObj = [];
        foreach($projetsGeneric as $pGen) {
            $projetsObj[] = self::makeObjectFromGeneric($pGen);
        }
        return $projetsObj;
    }

    public static function getById(int $id)
    {
        $sql = "SELECT * FROM " . static::$tableName . " where id_projet=$id";
        $result =  Model::Execute($sql);
        //Comme fetchAll [0] on récupère le premier élément sinon c'est $result
        return $result[0];
    }

    // TODO mettre dans une classe abstraite avec boucle sur l'objet generique
    private static function makeObjectFromGeneric($generic): Projet {
        $pObj = new Projet();
        $pObj->setDescription($generic->description);
        $pObj->setId_projet($generic->id_projet);
        $pObj->setId_utilisateur($generic->id_utilisateur);
        $pObj->setTitre($generic->titre);
        return $pObj;
    }
}
?>