<?php

namespace Jacques\ProjetPhpGestionProjets\Kernel;

class AbstractController
{
    private ?string $flashMessage = null;

    public function getFlashMessage()
    {
        return $this->flashMessage;
    }

    public function setFlashMessage(string $message, string $type)
    {
        if ($type === 'success') {
            $this->flashMessage = "<div class='' role='alert'>$message</div>";
            $_SESSION['flash'] = $this->flashMessage;
            return $this;
        }
        if ($type === 'error') {
            $this->flashMessage = "<div class='' role='alert'>$message</div>";
            $_SESSION['flash'] = $this->flashMessage;
            return $this;
        }
        $this->flashMessage = "<p>$message</p>";
        $_SESSION['flash'] = $this->flashMessage;
        return $this;
    }
}
