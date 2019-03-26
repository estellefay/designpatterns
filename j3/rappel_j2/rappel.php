<?php

// je veux que mon aigle plane...sans modifier l'existant, comment faire ?

interface Volant
{
	public function voler(): string;
}

class Aigle implements Volant
{
	public function voler(): string
	{
		return 'Je vole';
	}
}

interface Nageur
{
	public function nager(): string;
}

// Je veux que mon poisson puisse voler...sans modifier l'existant, comment faire ?
class Poisson implements Nageur
{
	public function nager(): string
	{
		return 'Je nage';
	}
}
