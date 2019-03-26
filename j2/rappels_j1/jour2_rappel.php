<?php

// Critiquez le code suivant
// Quels principes SOLID met-il à mal ?

class Personne
{
	private $prenom;

	private $age;

	public function __construct(string $prenom, int $age)
	{
		$this->prenom = $prenom;
		$this->age = $age;	
	}

	public function conduireVoiture(): void
	{
		$voiture = new Voiture();
		$voiture->conduire();
	}

	public function parlerDuTemps(): string
	{
		return "Y'a plus de saisons ma brave dame !";
	}

	public function partirAuTravail(): void
	{
		// routine du boulot :((
	}
}

$individu = new Personne('Eric', 25);
