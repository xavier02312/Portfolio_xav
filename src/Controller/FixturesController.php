<?php

require_once __DIR__ .'../../Repository/ProjectRepository.php';
require_once __DIR__ .'../../Repository/UserRepository.php';
require_once __DIR__ .'../../Entity/Project.php';
require_once __DIR__ .'../../Entity/User.php';

class FixturesController
{
	/**
	 * Nombre de données maximum à insérées
	 */
	private const MAX = 5;

	/**
	 * Permet de remplir la table "project" de données d'essais
	 */
	public function populate()
	{
		$faker = Faker\Factory::create();
		$projectRepository = new ProjectRepository();
		$userRepository = new UserRepository();

		// Vide la table SQL avant une insertion
		$projectRepository->drop();
		$userRepository->drop();

		// Boucle X fois
		for ($i = 0; $i <= self::MAX; $i++) {
			// Génère des dates aléatoires
			$dateCreated = $faker->dateTimeBetween('-1 year');
			$dateUpdated = $faker->dateTimeBetween('-1 year');

			// Créer un objet avec l'entité de la table voulue
			$project = (new Project())
				->setTitle($faker->sentence(3))
				->setDescription($faker->realText())
				->setPreview('test.jpg')
				->setCreatedAt($dateCreated->format('Y-m-d'))
				->setUpdatedAt($dateUpdated->format('Y-m-d'));

			// Passe cet objet au repository pour insertion en BDD
			$projectRepository->add($project);
		}

		// Insère un administrateur
		$user = (new User())
			->setUsername('admin')
			->setPassword(password_hash('secret', PASSWORD_ARGON2I));

		// Passe cet objet au repository pour insertion en BDD
		$userRepository->add($user);

		// Affiche la vue associée
		require_once __DIR__ .'../../../templates/fixtures/index.php';
	}
}
