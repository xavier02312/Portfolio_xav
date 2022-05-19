<?php

class ErrorController
{
    /**
     * Erreur 404
     * Page non trouvée
     */
    public function notFound()
    {
        require_once __DIR__ .'../../../templates/errors/error404.php';
    }
}
