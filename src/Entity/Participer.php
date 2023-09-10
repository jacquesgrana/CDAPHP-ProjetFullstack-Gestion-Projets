<?php
namespace Jacques\ProjetPhpGestionProjets\Entity;
use Jacques\ProjetPhpGestionProjets\Entity\Model;

class Participer {
    public static $tableName = 'participer';

    private $id_projet;
    private $id_utilisateur;
    private $id_tache;

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
}