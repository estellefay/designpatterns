<?php

interface LecteurInterface
{
    public function mettreSousTension(): void;
    public function lire(): void;
}

interface ProjecteurInterface
{
    public function mettreSousTension(): void;
    public function modePleinEcran(): void;
}

interface AmplificateurInterface
{
    public function mettreSousTension(): void;
    public function activerSonSurround(): void;
    public function reglerVolume(int $volume): void;
}

class LecteurBluRay implements LecteurInterface
{
    private $film;
    
    public function mettreSousTension(): void
    {
        echo "lecteur Blu-Ray sous tension".PHP_EOL;
    }
    
    public function __construct(string $film)
    {
        $this->film = $film;
    }
    
    public function lire(): void
    {
        echo "Lecture du film '".$this->film."'".PHP_EOL;
    }
}

class Projecteur implements ProjecteurInterface
{
    public function mettreSousTension(): void
    {
        echo "Projecteur sous tension".PHP_EOL;
    }
    
    public function modePleinEcran(): void
    {
        echo "Projecteur en mode plein écran".PHP_EOL;
    }
}

class Amplificateur implements AmplificateurInterface
{
    public function mettreSousTension(): void
    {
        echo "Amplificateur sous tension".PHP_EOL;
    }
    
    public function activerSonSurround(): void
    {
        echo "Son 3.1 activé sur l'amplificateur".PHP_EOL;
    }
    
    public function reglerVolume(int $volume): void
    {
        echo "Volume sur $volume sur l'amplificateur".PHP_EOL;
    }
}

class HomeCinemaFacade
{   
    private $lecteur;
    
    private $amplificateur;
    
    private $projecteur;
    
    public function __construct(LecteurInterface $lecteur, ProjecteurInterface $projecteur, AmplificateurInterface $amplificateur)
    {
        $this->lecteur = $lecteur;
        $this->projecteur = $projecteur;
        $this->amplificateur = $amplificateur;
    }
    
    public function regarderFilm(): void
    {
        $this->lecteur->mettreSousTension();
        $this->projecteur->mettreSousTension();
        $this->projecteur->modePleinEcran();
        $this->amplificateur->mettreSousTension();
        $this->amplificateur->activerSonSurround();
        $this->amplificateur->reglerVolume(5);
        
        $this->lecteur->lire();
    }
}

$lecteur = new LecteurBluRay("Bohemian Rhapsody");
$amplificateur = new Amplificateur();
$projecteur = new Projecteur();

$facade = new HomeCinemaFacade($lecteur, $projecteur, $amplificateur);

$facade->regarderFilm();
