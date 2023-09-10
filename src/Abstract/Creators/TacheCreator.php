<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract\Creators;
use Jacques\ProjetPhpGestionProjets\Abstract\Creator;
use Jacques\ProjetPhpGestionProjets\Entity\Tache;

/**
 * Classe fabrique de l'objet Tache
 */
class TacheCreator extends Creator {
    
    /**
     * Fabrique un objet Tache à partir d'un objet générique avec des 
     * propriétés publiques.
     */
    public static function makeObjectFromGeneric($generic): Tache {
        $tObj = new Tache();
        $tObj->setId_tache($generic->id_tache);
        $tObj->setNom($generic->nom);
        $tObj->setDescription($generic->description);
        $tObj->setId_utilisateur($generic->id_utilisateur);
        $tObj->setId_statut($generic->id_statut);
        $tObj->setId_priorite($generic->id_priorite);
        $tObj->setId_projet($generic->id_projet);
        return $tObj;
    }    
}
?>