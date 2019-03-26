<?php

interface TravailleurInterface
{
	public function partirAuTravail(): void;
}

interface BavardeurInterface
{
	public function parlerDuTemps(): string;
}

interface ConducteurInterface
{
	public function conduire(VehiculeInferface $vehicule): void;
}

abstract class VehiculeAbstract
{
	abstract public function conduire(): void;
}

interface VehiculeInferface
{
	public function conduire(): void;
}

class Tricycle implements VehiculeInferface
{
	public function conduire(): void
	{
		echo "je conduis un tricyle".PHP_EOL;
	}
}

class Voiture  implements VehiculeInferface
{
	public function conduire(): void
	{
		echo "je conduis une voiture".PHP_EOL;
	}
}

abstract class Personne
{
	protected $prenom;

	protected $age;

	public function __construct(string $prenom, int $age)
	{
		$this->prenom = $prenom;
		$this->age = $age;	
	}
}

class TravailleurBavardeurQuiConduit extends Personne implements TravailleurInterface, BavardeurInterface, ConducteurInterface
{
	public function conduire(VehiculeInferface $vehicule): void
	{
		$vehicule->conduire();
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

$individu = new TravailleurBavardeurQuiConduit('Eric', 25);
echo $individu->parlerDuTemps().PHP_EOL;

foreach ([new Tricycle(), new Voiture()] as $vehicule) {
	$individu->conduire($vehicule);
}

