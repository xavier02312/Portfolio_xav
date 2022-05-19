<?php

require_once '../src/Controller/HomeController.php';
require_once '../src/Controller/FixturesController.php';
require_once '../src/Controller/ErrorController.php';

/**
 * Fichier de configuration des routes
 */
switch($uri) {
    // Accueil
    case '/':
        $controller = new HomeController();
        $controller->index();
        break;

	// Fixtures
	case '/fixtures':
		$controller = new FixturesController();
		$controller->populate();
		break;

	// Error 404
    default:
        $controller = new ErrorController();
        $controller->notFound();
}
