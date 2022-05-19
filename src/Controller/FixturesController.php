<?php

require_once __DIR__ .'../../Repository/ProjectRepository.php';

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

		// Vide la table SQL avant une insertion
		$projectRepository->drop();

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

		// Affiche la vue associée
		require_once __DIR__ .'../../../templates/fixtures/index.php';
	}
}
