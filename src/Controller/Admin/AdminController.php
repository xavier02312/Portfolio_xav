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
	 * Utilises le constructeur pour vérifier si le visiteur à l'autorisation d'accéder
	 * à l'administration
	 *
	 * Le fait de placer ce code dans le controller protège toutes les vues
	 * de mon administration ;)
	 */
	public function __construct()
	{
		/**
		 * Si la session "user" n'existe pas ou que celle-ci ne possède pas le rôle "ROLE_ADMIN",
		 * alors je redirige le visiteur sur la page de connexion
		 */
		if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ROLE_ADMIN') {
			header('Location: /login');
		}
	}

	/**
	 * Liste tous les projets
	 */
	public function index()
	{
		// Sélectionne tous les projets
		$projetRepository = new ProjectRepository();
		$projects = $projetRepository->all();

		// Charge la vue associée
		require_once __DIR__ .'../../../../templates/admin/index.php';
	}

	/**
	 * Ajoute un nouveau projet
	 */
	public function new()
	{
		// Si le formulaire est envoyé
		if (!empty($_POST)) {

			// Permet de mettre le bandeau du message en vert sur la vue
			$success = 'success';

			// Test des superglobales
			// dump($_POST, $_FILES);

			// Vérifie que les champs soient bien remplis
			if (!empty($_POST['title']) && !empty($_POST['description']) && $_FILES['preview']['error'] === 0) {

				// Appelle le service d'upload pour gérer le fichier
				$uploadService = new UploadService;
				$file = $uploadService->upload($_FILES['preview']);

				// Si aucune erreur lors de l'upload
				if ($file) {
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
				else {
					$success = 'danger';
					$message = 'Le fichier est incorrect';
				}
			}

			// Sinon retourne une erreur
			else {
				$success = 'danger';
				$message = 'Tous les champs sont obligatoires';
			}
		}

		// Charge la vue associée contenant le formulaire d'ajout
		require_once __DIR__ .'../../../../templates/admin/new.php';
	}

	/**
	 * Edite un projet
	 */
	public function edit()
	{
		// Sélectionne un projet
		$projetRepository = new ProjectRepository();
		$project = $projetRepository->select($_GET['id']);

		// Si le formulaire est envoyé
		if (!empty($_POST)) {

			// Permet de mettre le bandeau du message en vert sur la vue
			$success = 'success';
			$error = false;

			// Vérifie que les champs soient bien remplis
			if (!empty($_POST['title']) && !empty($_POST['description'])) {

				// Upload si un fichier est envoyé
				if ($_FILES['preview']['error'] === 0) {
					// Appelle le service d'upload pour gérer le fichier
					$uploadService = new UploadService;
					$file = $uploadService->upload($_FILES['preview']);

					// Si aucune erreur lors de l'upload
					if ($file) {
						// Supprime l'ancienne image
						unlink("preview-projects/{$project->getPreview()}");

						// Stocke le nouveau nom de l'image
						$project->setPreview($file);
					}
					else {
						$error = true;
						$success = 'danger';
						$message = 'Le fichier est incorrect';
					}
				}

				// Si aucune erreur généré lors d'un potentiel upload, on met à jour
				if (!$error) {
					// Créer un objet avec l'entité Project contenant les données du formulaire
					$project->setTitle($_POST['title']);
					$project->setDescription($_POST['description']);

					// Edite le projet en table
					$projetRepository = new ProjectRepository();
					$projetRepository->edit($project);

					$message = 'Le nouveau projet est correctement modifié';
				}
			}

			// Sinon retourne une erreur
			else {
				$success = 'danger';
				$message = 'Tous les champs sont obligatoires';
			}
		}

		// Charge la vue associée contenant le formulaire d'édition
		require_once __DIR__ .'../../../../templates/admin/edit.php';
	}

	/**
	 * Supprimer un projet
	 */
	public function delete()
	{
		// Supprimer un projet
		$projetRepository = new ProjectRepository();
		$delete = $projetRepository->delete($_GET['id']);

		// Génère un message selon la réussite de la suppression
		$message = $delete === 1 ? 'Le projet à bien été supprimé' : 'Ce projet n\'existe pas';
		$success = $delete === 1 ? 'success' : 'danger';

		// Redirige vers la liste des projets
		header("Location: /admin?message=$message&success=$success");
	}
}
