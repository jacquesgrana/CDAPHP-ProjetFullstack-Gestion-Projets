<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract\Creators;
use Jacques\ProjetPhpGestionProjets\Abstract\Creator;
use Jacques\ProjetPhpGestionProjets\Entity\Tache;


class TacheCreator extends Creator {
    /*
    public static function make($data): Tache {
        $tache = new Tache();

    foreach($data as $key => $value) {
        $method = 'set' . ucfirst($key);
        if (method_exists($tache, $method)) {
            $tache->$method($value);
        }
    }
    return $tache;
    }*/

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