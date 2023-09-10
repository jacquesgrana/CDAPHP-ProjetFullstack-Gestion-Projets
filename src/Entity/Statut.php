<?php
namespace Jacques\ProjetPhpGestionProjets\Entity;
use Jacques\ProjetPhpGestionProjets\Entity\Model;

class Statut {
    public static $tableName = 'statut';

    private int $id_statut;
    private string $statut;

    


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
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }
}

?>