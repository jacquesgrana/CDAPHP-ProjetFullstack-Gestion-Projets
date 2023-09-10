<?php
namespace Jacques\ProjetPhpGestionProjets\Entity;
use Jacques\ProjetPhpGestionProjets\Entity\Model;

class Priorite {
    public static $tableName = 'priorite';

    private int $id_priorite;
    private string $priorite;

    

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
     * Get the value of priorite
     */ 
    public function getPriorite()
    {
        return $this->priorite;
    }

    /**
     * Set the value of priorite
     *
     * @return  self
     */ 
    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;

        return $this;
    }
}
?>