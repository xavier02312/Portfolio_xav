<?php

require_once __DIR__ .'../../../core/Db.php';
require_once __DIR__ .'../../Entity/User.php';

/**
 * Gère le CRUD sur la table "user"
 */
class UserRepository extends Db
{
	/**
	 * Insert des données
	 */
	public function add(User $user)
	{
		try {
			$query = $this->getDb()->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
			$query->bindValue(':username', $user->getUsername());
			$query->bindValue(':password', $user->getPassword());

			return $query->execute();
		}
		catch(Exception $exception) {
			die("Erreur lors de l'insertion en table user : {$exception->getMessage()}");
		}
	}

	/**
	 * Vérifie la présence d'un utilisateur
	 */
	public function check(User $user)
	{
		try {
			$query = $this->getDb()->prepare("SELECT * FROM user WHERE username = :username");
			$query->bindValue(':username', $user->getUsername());
			$query->execute();
			$user = $query->fetch();

			// Créer un objet avec l'entité User contenant les données du formulaire
			$userObject = (new User())
				->setUsername($user['username'])
				->setPassword($user['password']);

			return $userObject ?? false;
		}
		catch(Exception $exception) {
			die("Erreur lors de l'insertion en table user : {$exception->getMessage()}");
		}
	}

	/**
	 * Vide la table SQL
	 */
	public function drop()
	{
		try {
			return $this->getDb()->query('TRUNCATE TABLE user');
		}
		catch(Exception $exception) {
			die("Erreur lors du vidage de la table user : {$exception->getMessage()}");
		}
	}
}
