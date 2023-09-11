<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;
use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Kernel\DataBase;
use Jacques\ProjetPhpGestionProjets\Abstract\Creators\UtilisateurCreator;

class UtilisateurDB extends Model {
    public static $tableName = 'utilisateur';

    // TODO faire requête préparée
    /**
     * Fonction qui récupère u utilisateur selon son email.
     * @param string $email : email de l'utilisateur
     * @return ?Utilisateur
     */
    public static function getUserByEmail(string $email): ?Utilisateur 
    {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE email='$email'";
        $userGen = Model::Execute($sql);
        if(count($userGen) > 0) {
            return UtilisateurCreator::makeObjectFromGeneric($userGen[0]);
        }
        else {
            return null;
        }
        
    }

    /**
     * Fonction qui renvoie vrai si l'email est déjà présent
     * dans la table utilisateur.
     * @param string $email : email à tester
     * @return bool vrai si email présent dans la table
     */
    public static function isEmailIsInDB(string $email): bool {
        if(self::getUserByEmail($email) === null) {
            return false;
        }
        else {
            return true;
        }
    }
    
   /**
     * Fonction qui insère un nouveau tuple.
     * @param : propriétés du nouveau tuple.
     */
    public static function insertUtilisateur($nom, $prenom, $hash, $email) {     
        $sql = "INSERT INTO " . self::$tableName . 
        " (nom, prenom, mdp, email) 
        VALUES ('$nom', '$prenom', '$hash', '$email')";
        //echo 'sql' . $sql . '<br />';
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
    }

    /*
    // TODO mettre dans une classe abstraite avec boucle sur l'objet generique et ajouter le nom de l'objet concret en parametre
    private static function makeObjectFromGeneric($generic): Utilisateur {
        $userObj = new Utilisateur();
        $userObj->setId_utilisateur($generic->id_utilisateur);
        $userObj->setEmail($generic->email);
        $userObj->setMdp($generic->mdp);
        $userObj->setNom($generic->nom);
        $userObj->setPrenom($generic->prenom);
        return $userObj;
    }
    */
}