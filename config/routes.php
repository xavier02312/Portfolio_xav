<?php

// Public
require_once '../src/Controller/HomeController.php';
require_once '../src/Controller/FixturesController.php'; // Warning !
require_once '../src/Controller/ErrorController.php';

// Administration
require_once '../src/Controller/Admin/AdminController.php';

/**
 * Fichier de configuration des routes
 */
switch($uri) {
    // Accueil
    case '/':
        $controller = new HomeController();
        $controller->index();
        break;

	// Ajout d'un projet
	case '/project/add':
		$controller = new AdminController();
		$controller->new();
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
