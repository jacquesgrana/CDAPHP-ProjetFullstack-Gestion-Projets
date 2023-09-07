<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Tache;
use Jacques\ProjetPhpGestionProjets\Entity\Model;

class TacheDB {
    
    public static $tableName = 'tache';

    public static function getByProjetId(int $id_projet): array {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id_projet=$id_projet";
        $tachesGeneric = Model::Execute($sql);
        $tachesObj = [];
        foreach($tachesGeneric as $tGen) {
            $tachesObj[] = self::makeObjectFromGeneric($tGen);
        }
        return $tachesObj;
    }

    public static function getAllByProjetId(int $id_projet): array {
        $sql = "SELECT t.id_tache , t.nom , t.description , u.nom , u.prenom , s.statut , pri.priorite 
        FROM tache t, utilisateur u , statut s , priorite pri, projet pro
        WHERE pro.id_projet = " . $id_projet . "
        AND t.id_utilisateur = u.id_utilisateur 
        AND t.id_statut = s.id_statut 
        AND t.id_priorite = pri.id_priorite
        AND t.id_projet = pro.id_projet ";
        $taches = Model::Execute($sql);
        return $taches;
    }

    // TODO mettre dans une classe abstraite avec boucle sur l'objet generique
    private static function makeObjectFromGeneric($generic): Tache {
        $tObj = new Tache();
        $tObj->setId_tache($generic->id_tache);
        $tObj->setNom($generic->nom);
        $tObj->setDescription($generic->description);
        $tObj->setId_utilisateur($generic->id_utilisateur);
        $tObj->setId_statut($generic->id_statut);
        $tObj->setId_priorite($generic->id_priorite);
        $tObj->setId_projet($generic->id_projet);
        //var_dump($tObj);
        return $tObj;
    }
}
?>