<?php
session_start();
require('vendor/autoload.php');
use Jacques\ProjetPhpGestionProjets\Kernel\Dispatcher;
$dispatcher = new Dispatcher();
$dispatcher->dispatch();
?>