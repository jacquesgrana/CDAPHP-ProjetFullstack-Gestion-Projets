<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract\Creators;
use Jacques\ProjetPhpGestionProjets\Abstract\Creator;
use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;

/**
 * Classe fabrique de l'objet Utilisateur
 */
class UtilisateurCreator extends Creator {

     /**
     * Fabrique un objet Utilisateur à partir d'un objet générique avec des 
     * propriétés publiques.
     */
    public static function makeObjectFromGeneric($generic): Utilisateur {
        $userObj = new Utilisateur();
        $userObj->setId_utilisateur($generic->id_utilisateur);
        $userObj->setEmail($generic->email);
        $userObj->setMdp($generic->mdp);
        $userObj->setNom($generic->nom);
        $userObj->setPrenom($generic->prenom);
        return $userObj;
    }
}
?>