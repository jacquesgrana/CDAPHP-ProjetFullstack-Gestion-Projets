<?php
namespace Jacques\ProjetPhpGestionProjets\Abstract;

use Jacques\ProjetPhpGestionProjets\Abstract\Entity;

abstract class Creator {
    public abstract static function make(...$data): Entity;
    public abstract static function makeObjectFromGeneric($generic): Entity;    
}
?>