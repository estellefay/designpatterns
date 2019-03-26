<?php

interface LivreInterface
{
	public function tournerPage(): void;
	public function ouvrir(): void;
}

class LivrePapier implements LivreInterface
{
	private $page;

	public function tournerPage(): void
	{
		$this->page++;
	}

	public function ouvrir(): void
	{
		$this->page = 1;
	}
}

class Lecteur
{
	private $livre;

	public function __construct(LivreInterface $livre)
	{
		$this->livre = $livre;
	}

	public function lire()
	{
		$this->livre->ouvrir();
		$this->livre->tournerPage();	
	}
}

$lecteur = new Lecteur(new LivrePapier());
$lecteur->lire();

interface LiseuseInterface
{
    public function demarrer(): void;
    public function appuyerPageSuivante(): void;
}

class Kobo implements LiseuseInterface
{
	private $page;

    public function demarrer(): void
    {
    	$this->page = 1;
    }

    public function appuyerPageSuivante(): void
    {
    	$this->page++;
    }

}

class AdaptateurLiseuse implements LivreInterface
{
	private $liseuse;

	public function __construct(LiseuseInterface $liseuse)
	{
		$this->liseuse = $liseuse;
	}
	
	public function tournerPage(): void
	{
		$this->liseuse->appuyerPageSuivante();
	}

	public function ouvrir(): void
	{
		$this->liseuse->demarrer();
	}
}

$adaptateur = new AdaptateurLiseuse(new Kobo());
$lecteur = new Lecteur($adaptateur);
$lecteur->lire();
