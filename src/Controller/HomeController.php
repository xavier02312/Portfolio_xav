<?php

require_once __DIR__ .'../../Repository/ProjectRepository.php';

class HomeController
{
    /**
     * Homepage
     */
    public function index()
    {
		// Sélectionne tous les projets
		$projetRepository = new ProjectRepository();
		$projects = $projetRepository->all();

		// Charge la vue associée
        require_once __DIR__ .'../../../templates/index.php';
    }

	/**
	 * Détails d'un projet
	 */
	public function details()
	{
		// Sélectionne tous les projets
		$projetRepository = new ProjectRepository();
		$project = $projetRepository->select($_GET['id']);

		// Charge la vue associée
		require_once __DIR__ .'../../../templates/details.php';
	}
}
