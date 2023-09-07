<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;
use Jacques\ProjetPhpGestionProjets\Entity\Model;


class UtilisateurDB {
    public static $tableName = 'utilisateur';

    // TODO faire requête préparée
    // TODO factory pour construire l'userObj ?
    public static function getUserByEmail(string $email): Utilisateur 
    {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE email='$email'";
        $userGen = Model::Execute($sql)[0];
        //echo 'user tab :';
        //var_dump($userTab);
        //echo '<br />';
        
        //echo 'user obj :';
        //var_dump($userObj);
        return self::makeObjectFromGeneric($userGen);
    }

    // TODO mettre dans une classe abstraite avec boucle sur l'objet generique
    private static function makeObjectFromGeneric($generic): Utilisateur {
        $userObj = new Utilisateur();
        $userObj->setId_utilisateur($generic->id_utilisateur);
        $userObj->setEmail($generic->email);
        $userObj->setMdp($generic->mdp);
        $userObj->setNom($generic->nom);
        $userObj->setPrenom($generic->prenom);
        return $userObj;
    }
}