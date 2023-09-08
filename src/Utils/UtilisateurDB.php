<?php
namespace Jacques\ProjetPhpGestionProjets\Utils;
use Jacques\ProjetPhpGestionProjets\Entity\Utilisateur;
use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Kernel\DataBase;


class UtilisateurDB {
    public static $tableName = 'utilisateur';

    // TODO faire requête préparée
    // TODO factory pour construire l'userObj ?
    public static function getUserByEmail(string $email): ?Utilisateur 
    {
        $sql = "SELECT * FROM " . self::$tableName . " WHERE email='$email'";
        $userGen = Model::Execute($sql);
        //echo 'user tab :';
        //var_dump($userTab);
        //echo '<br />';
        //echo 'user obj :';
        if(count($userGen) > 0) {
            return self::makeObjectFromGeneric($userGen[0]);
        }
        else {
            return null;
        }
        
    }

    public static function isEmailIsInDB(string $email): bool {
        if(self::getUserByEmail($email) === null) {
            //echo'pas dedans';
            return false;
        }
        else {
            //echo'deja dedans';
            return true;
        }
    }
    

    public static function insert($nom, $prenom, $hash, $email) {
        //echo 'insert';
        
        $sql = "INSERT INTO " . self::$tableName . 
        " (nom, prenom, mdp, email) 
        VALUES ('$nom', '$prenom', '$hash', '$email')";
        //echo 'sql' . $sql . '<br />';
        $db = DataBase::getInstance();
        $stmt = $db->prepare($sql);
        return $stmt->execute();
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