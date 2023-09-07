<?php
namespace Jacques\ProjetPhpGestionProjets\Entity;
use Jacques\ProjetPhpGestionProjets\Entity\Model;

class Tache extends Model {
    public static $tableName = 'tache';

    private int $id_tache;
    private string $nom;
    private string $description;
    private int $id_utilisateur;
    private int $id_statut;
    private int $id_priorite;
    private int $id_projet;

    /**
     * Get the value of id_tache
     */ 
    public function getId_tache()
    {
        return $this->id_tache;
    }

    /**
     * Set the value of id_tache
     *
     * @return  self
     */ 
    public function setId_tache($id_tache)
    {
        $this->id_tache = $id_tache;
        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

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

    /**
     * Get the value of id_statut
     */ 
    public function getId_statut()
    {
        return $this->id_statut;
    }

    /**
     * Set the value of id_statut
     *
     * @return  self
     */ 
    public function setId_statut($id_statut)
    {
        $this->id_statut = $id_statut;
        return $this;
    }

    /**
     * Get the value of id_priorite
     */ 
    public function getId_priorite()
    {
        return $this->id_priorite;
    }

    /**
     * Set the value of id_priorite
     *
     * @return  self
     */ 
    public function setId_priorite($id_priorite)
    {
        $this->id_priorite = $id_priorite;
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
    public function setId_projet($id_projet)
    {
        $this->id_projet = $id_projet;
        return $this;
    }
}
?>