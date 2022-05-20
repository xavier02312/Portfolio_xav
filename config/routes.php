<?php

// Public
require_once '../src/Controller/HomeController.php';
require_once '../src/Controller/AuthController.php';
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

	// Détails d'un projet
	case '/project/detail':
		$controller = new HomeController();
		$controller->details();
		break;

	// Connexion
	case '/login':
		$controller = new AuthController();
		$controller->login();
		break;

	// Déconnexion
	case '/logout':
		$controller = new AuthController();
		$controller->logout();
		break;

	// Administration - Liste des projets
	case '/admin':
		$controller = new AdminController();
		$controller->index();
		break;

	// Administration - Ajout d'un projet
	case '/admin/project/add':
		$controller = new AdminController();
		$controller->new();
		break;

	// Administration - Edite un projet
	case '/admin/project/edit':
		$controller = new AdminController();
		$controller->edit();
		break;

	// Administration - Supprimer un projet
	case '/admin/project/delete':
		$controller = new AdminController();
		$controller->delete();
		break;

	// Fixtures
	case '/fixtures':
		$controller = new FixturesController();
		$controller->populate();
		break;

	// Error 404 - Page not found
    default:
        $controller = new ErrorController();
        $controller->notFound();
}
