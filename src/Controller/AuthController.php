<?php

/**
 * Gestion de l'authentification
 */
class AuthController
{
	/**
	 * Connexion à l'administration
	 */
	public function login()
	{
		// Si le formulaire de connexion est envoyé
		if (!empty($_POST)) {
			// Permet de mettre le bandeau du message en vert sur la vue
			$success = 'success';

			// Vérifie que les champs soient bien remplis
			if (!empty($_POST['username']) && !empty($_POST['password'])) {

				// Créer un objet avec l'entité User contenant les données du formulaire
				$user = (new User())
					->setUsername($_POST['username'])
					->setPassword($_POST['password']);

				// Vérifie si l'utilisateur existe
				$userRepository = new UserRepository();
				$isExist = $userRepository->check($user);

				// Si un enregistrement existe
				if ($isExist) {

					// On test le mot de passe
					if (password_verify($user->getPassword(), $isExist->getPassword())) {
						// Créer de la session administrateur
						$_SESSION['user'] = [
							'username' => $user->getUsername(),
							'role' => 'ROLE_ADMIN'
						];

						// Redirection sur la page d'accueil de l'administration
						header('Location: /admin');
					}
				}

				$success = 'danger';
				$message = 'Identifiant et/ou mot de passe incorrect';
			}

			// Sinon retourne une erreur
			else {
				$success = 'danger';
				$message = 'Tous les champs sont obligatoires';
			}
		}

		// Charge la vue associée
		require_once __DIR__ .'../../../templates/auth/index.php';
	}

	/**
	 * Déconnexion utilisateur
	 */
	public function logout()
	{
		session_unset();
		session_destroy();

		header('Location: /');
	}
}
