<?php

namespace Jacques\ProjetPhpGestionProjets\Utils;

use Jacques\ProjetPhpGestionProjets\Entity\Tache;
use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Kernel\DataBase;
use Jacques\ProjetPhpGestionProjets\Abstract\Creators\TacheCreator;

// TODO mettre des try/catch !!!!

/**
 * Classe chargée d'exécuter des requêtes sur la table tache.
 */
class TacheDB extends Model
{
    public static $tableName = 'tache';

    /**
     * Fonction qui renvoie les tâches selon l'id du projet.
     * @param int $id_projet : id du projet
     * @return array : tableau de Tache
     */
    public static function getByProjetId(int $id_projet): array
    {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id_projet=$id_projet";
        $tachesGeneric = Model::Execute($sql);
        $tachesObj = [];
        foreach ($tachesGeneric as $tGen) {
            $tachesObj[] = TacheCreator::makeObjectFromGeneric($tGen);
        }
        return $tachesObj;
    }

    /**
     * Fonction qui renvoie les tâches et d'autres informations 
     * selon l'id du projet.
     * @param int $id_projet : id du projet
     * @return array : tableau d'objets génériques
     */
    public static function getAllByProjetId(int $id_projet): array
    {
        $sql = "SELECT t.id_tache , t.nom AS nom_tache , t.description , u.nom , u.prenom , u.id_utilisateur, s.statut , pri.priorite 
        FROM tache t, utilisateur u , statut s , priorite pri, projet pro
        WHERE pro.id_projet = " . $id_projet . "
        AND t.id_utilisateur = u.id_utilisateur 
        AND t.id_statut = s.id_statut 
        AND t.id_priorite = pri.id_priorite
        AND t.id_projet = pro.id_projet ";
        $taches = Model::Execute($sql);
        return $taches;
    }

     /**
     * Fonction qui modifie un tuple selon son id.
     * @param int $id_projet : id du tuple à modifier
     * @param : le reste, propriétés du tuple à modifier.
     */
    public static function updateTache($id_tache, $nom, $description, $id_utilisateur, $id_statut, $id_priorite, $id_projet)
    {
        $sql = "UPDATE " . self::$tableName .
            " SET nom = '$nom', description = '$description', id_utilisateur = $id_utilisateur, id_statut = $id_statut, id_priorite = $id_priorite, id_projet = $id_projet" .
            " WHERE id_tache=" . $id_tache;
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    /**
     * Fonction qui insère un nouveau tuple.
     * @param : propriétés du nouveau tuple.
     */
    public static function insertTache(string $nom, string $description, int $id_utilisateur, int $id_statut, int $id_priorite, int $id_projet)
    {
        $sql = "INSERT INTO " . self::$tableName .
            " (nom, description, id_utilisateur, id_statut, id_priorite, id_projet)" . 
            " VALUES ('$nom', '$description', $id_utilisateur, $id_statut, $id_priorite, $id_projet)";

        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        $success = $stmt->execute();

        if ($success) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    }

    /**
     * Fonction qui supprime un tuple selon son id.
     * @param int $id_projet : id du tuple à supprimer
     */
    public static function deleteTache(int $id_tache)
    {
        $sql = "DELETE FROM " . self::$tableName . " WHERE id_tache=" . $id_tache;
        //echo 'sql : ' . $sql . '<br />';

        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    /**
     * Fonction qui renvoie l'id de l'utilisateur directeur de la tache
     * dont l'id est en paramètre.
     * @param int $id_tache : id de la tâche à tester
     * @return int : id du directeur de la tâche
     */
    public static function getUtilisateurIdByTacheId($id_tache): int {
        $sql ="SELECT p.id_utilisateur 
        FROM projet p , tache t 
        WHERE p.id_projet = t.id_projet 
        AND t.id_tache = $id_tache";
        $result = Model::Execute($sql)[0];
        $toReturn = $result->id_utilisateur;
        return intval($toReturn);
    }
}
