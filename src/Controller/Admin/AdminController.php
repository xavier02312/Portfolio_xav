<?php

require_once __DIR__ .'../../../Repository/ProjectRepository.php';
require_once __DIR__ .'../../../Service/UploadService.php';
require_once __DIR__ .'../../../Entity/Project.php';

/**
 * Administration du portfolio
 */
class AdminController
{
	/**
	 * Ajoute un nouveau projet
	 */
	public function new()
	{
		// Si le formulaire est envoyé
		if (!empty($_POST)) {

			// Test des superglobales
			// dump($_POST, $_FILES);

			// Permet de mettre le bandeau du message en vert sur la vue
			$success = 'success';

			// Vérifie que les champs soient bien remplis
			if (!empty($_POST['title']) && !empty($_POST['description']) && $_FILES['preview']['error'] === 0) {

				// Appelle le service d'upload pour gérer le fichier
				$uploadService = new UploadService;
				$file = $uploadService->upload($_FILES['preview']);

				// Créer un objet avec l'entité Project contenant les données du formulaire
				$project = (new Project())
					->setTitle($_POST['title'])
					->setDescription($_POST['description'])
					->setPreview($file);

				// Insère le projet en table
				$projetRepository = new ProjectRepository();
				$projetRepository->add($project);

				$message = 'Le nouveau projet est correctement enregistré';
			}

			// Sinon retourne une erreur
			else {
				$success = 'danger';
				$message = 'Tous les champs sont obligatoires';
			}
		}

		// Charge la vue associée contenant le formulaire d'ajout
		require_once __DIR__ .'../../../../templates/project/new.php';
	}
}
