<?php

/**
 * Structure de la table SQL "project"
 */
class Project
{
	private int $id;
	private string $title;
	private string $description;
	private string $preview;
	private string $createdAt;
	private string $updatedAt;

	/**
	 * Injecte la date du jour automatiquement à mes propriétés
	 */
	public function __construct()
	{
		$date = new DateTime('now');
		$this->createdAt = $date->format('Y-m-d');
		$this->updatedAt = $date->format('Y-m-d');
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Project
	 */
	public function setId(int $id): Project
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return Project
	 */
	public function setTitle(string $title): Project
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 * @return Project
	 */
	public function setDescription(string $description): Project
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPreview(): string
	{
		return $this->preview;
	}

	/**
	 * @param string $preview
	 * @return Project
	 */
	public function setPreview(string $preview): Project
	{
		$this->preview = $preview;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCreatedAt(): string
	{
		return $this->createdAt;
	}

	/**
	 * @param string $createdAt
	 * @return Project
	 */
	public function setCreatedAt(string $createdAt): Project
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUpdatedAt(): string
	{
		return $this->updatedAt;
	}

	/**
	 * @param string $updatedAt
	 * @return Project
	 */
	public function setUpdatedAt(string $updatedAt): Project
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}
}
