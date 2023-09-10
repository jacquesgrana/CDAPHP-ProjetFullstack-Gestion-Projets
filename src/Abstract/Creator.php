<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract;

use Jacques\ProjetPhpGestionProjets\Abstract\Entity;

/**
 * Fabrique abstraite qui manipule l'objet Entity
 */
abstract class Creator {

    /**
     * Fonction qui fabrique un objet à partir de $data
     * @Param : tableau associatif contenant les données 
     * de l'objet à fabriquer
     * @Return : objet fabriqué
     */
    public static function make($data): Entity {
        $entity = new Entity();

    foreach($data as $key => $value) {
        $method = 'set' . ucfirst($key);
        if (method_exists($entity, $method)) {
            $entity->$method($value);
        }
    }
    return $entity;
    }

    public abstract static function makeObjectFromGeneric($generic): Entity;    
}
?>