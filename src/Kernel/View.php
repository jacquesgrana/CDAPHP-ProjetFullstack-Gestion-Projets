<?php

namespace Jacques\ProjetPhpGestionProjets\Kernel;

use Jacques\ProjetPhpGestionProjets\Configuration\Config;
use Jacques\ProjetPhpGestionProjets\Model;

class View
{
    private string $main;
    private string $head;
    private string $header;
    private string $footer;
    private string $flashMsg;


    public function setMain(string $main): self
    {
        $this->main = Config::VIEWS . $main;
        return $this;
    }


    public function setHead(string $head): self
    {
        $this->head = Config::TEMPLATES . $head;
        return $this;
    }

    public function setHeader(string $header): self
    {
        $this->header = Config::TEMPLATES . $header;
        return $this;
    }


    public function setFooter(string $footer): self
    {
        $this->footer = Config::TEMPLATES . $footer;
        return $this;
    }


    public function render(array $vars)
    {
        extract($vars);
        //var_dump($this->main);
        include(dirname(__FILE__) . "/../" . $this->head);
        include(dirname(__FILE__) . "/../" . $this->header);
        include(dirname(__FILE__) . "/../" . $this->main);
        include(dirname(__FILE__) . "/../" . $this->footer);
    }
}
