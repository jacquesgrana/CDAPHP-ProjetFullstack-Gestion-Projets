<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract\Creators;
use Jacques\ProjetPhpGestionProjets\Abstract\Creator;
use Jacques\ProjetPhpGestionProjets\Entity\Projet;

/**
 * Classe fabrique de l'objet Projet
 */
class ProjetCreator extends Creator {

    /**
     * Fabrique un objet Projet à partir d'un objet générique avec des 
     * propriétés publiques.
     */
    public static function makeObjectFromGeneric($generic): Projet {
        $pObj = new Projet();
        $pObj->setId_projet($generic->id_projet);
        $pObj->setDescription($generic->description);
        $pObj->setId_utilisateur($generic->id_utilisateur);
        $pObj->setTitre($generic->titre);
        return $pObj;
    }
}
?>