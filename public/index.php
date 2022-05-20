<?php

/**
 * Démarre la session dans le point d'entrée afin que celle-ci
 * soit utilisable dans la totalité de mon application
 */
session_start();

require_once '../core/Router.php';
require_once '../vendor/autoload.php';

// Activation du router afin de rediriger le visiteur sur la bonne page
$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);
