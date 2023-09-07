<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Projet;
use Jacques\ProjetPhpGestionProjets\Entity\Model;

class ProjetDB {
    public static $tableName = 'projet';

    // TODO faire requête préparée
    // TODO factory pour construire l'$projetsObj ?
    public static function getByDirectorUserId(int $id_utilisateur) {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id_utilisateur=$id_utilisateur";
        $projetsGeneric = Model::Execute($sql);
        // TODO remplacer par un map
        $projetsObj = [];
        foreach($projetsGeneric as $pGen) {
            $projetsObj[] = self::makeObjectFromGeneric($pGen);
        }
        return $projetsObj;
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