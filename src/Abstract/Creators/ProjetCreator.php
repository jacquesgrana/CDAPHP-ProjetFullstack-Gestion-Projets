<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract\Creators;
use Jacques\ProjetPhpGestionProjets\Abstract\Creator;
use Jacques\ProjetPhpGestionProjets\Entity\Projet;

class ProjetCreator extends Creator {

    public static function makeObjectFromGeneric($generic): Projet {
        $pObj = new Projet();
        $pObj->setDescription($generic->description);
        $pObj->setId_projet($generic->id_projet);
        $pObj->setId_utilisateur($generic->id_utilisateur);
        $pObj->setTitre($generic->titre);
        return $pObj;
    }
}
?>