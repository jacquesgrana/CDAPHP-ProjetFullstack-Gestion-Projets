<?php
namespace Jacques\ProjetPhpGestionProjets\Entity;
use Jacques\ProjetPhpGestionProjets\Entity\Model;
use Jacques\ProjetPhpGestionProjets\Abstract\Entity;

class Projet implements Entity{
    public static $tableName = 'projet';

    private int $id_projet;
    private string $titre;
    private string $description;
    private int $id_utilisateur;

    

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get the value of id_projet
     */ 
    public function getId_projet()
    {
        return $this->id_projet;
    }

    /**
     * Set the value of id_projet
     *
     * @return  self
     */ 
    public function setId_projet($id)
    {
        $this->id_projet = $id;
        return $this;
    }

   

    /**
     * Get the value of id_utilisateur
     */ 
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */ 
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }
}
?>