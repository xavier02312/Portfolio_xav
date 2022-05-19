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
}
