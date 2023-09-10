<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract;

use Jacques\ProjetPhpGestionProjets\Abstract\Entity;

abstract class Creator {
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