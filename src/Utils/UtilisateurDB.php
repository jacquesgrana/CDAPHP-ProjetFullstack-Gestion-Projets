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
        $userTab = Model::Execute($sql)[0];
        //echo 'user tab :';
        //var_dump($userTab);
        //echo '<br />';
        $userObj = new Utilisateur();
        //echo 'id : ' . $userTab->id_utilisateur;
        $userObj->setId_utilisateur($userTab->id_utilisateur);
        $userObj->setEmail($userTab->email);
        $userObj->setMdp($userTab->mdp);
        $userObj->setNom($userTab->nom);
        $userObj->setPrenom($userTab->prenom);
        //echo 'user obj :';
        //var_dump($userObj);
        return $userObj;
    }
}