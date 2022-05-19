<?php

require_once __DIR__ .'../../../core/Db.php';
require_once __DIR__ .'../../Entity/Project.php';

/**
 * Gère le CRUD sur la table "project"
 */
class ProjectRepository extends Db {

	/**
	 * Insert des données
	 */
	public function add(Project $project)
	{
		try {
			$query = $this->getDb()->prepare("INSERT INTO project (title, description, preview, created_at, updated_at) VALUES (:title, :description, :preview, :created_at, :updated_at)");
			$query->bindValue(':title', $project->getTitle());
			$query->bindValue(':description', $project->getDescription());
			$query->bindValue(':preview', $project->getPreview());
			$query->bindValue(':created_at', $project->getCreatedAt());
			$query->bindValue(':updated_at', $project->getUpdatedAt());

			return $query->execute();
		}
		catch(Exception $exception) {
			die("Erreur lors de l'insertion en table project : {$exception->getMessage()}");
		}
	}

	/**
	 * Sélectionne toutes les données
	 */
	public function all()
	{
		try {
			$query = $this->getDb()->query('SELECT * FROM project');
			$projects = $query->fetchAll();

			foreach($projects as $project) {
				// Créer un objet avec l'entité de la table voulue
				$entityProject = (new Project())
					->setId($project['id'])
					->setTitle($project['title'])
					->setDescription($project['description'])
					->setPreview($project['preview'])
					->setCreatedAt($project['created_at'])
					->setUpdatedAt($project['updated_at']);

				// Ajoute l'objet dans un tableau
				$objectProjects[] = $entityProject;
			}

			return $objectProjects ?? [];
		}
		catch(Exception $exception) {
			die("Erreur lors de la sélection en table project : {$exception->getMessage()}");
		}
	}

	/**
	 * Vide la table SQL
	 */
	public function drop()
	{
		try {
			return $this->getDb()->query('TRUNCATE TABLE project');
		}
		catch(Exception $exception) {
			die("Erreur lors du vidage de la table project : {$exception->getMessage()}");
		}
	}
}
