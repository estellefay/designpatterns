<?php

final class InspecteurPermisConduire
{
    private $candidat;
     
    public function __construct(ConducteurInterface $conducteur)
    {
        $this->candidat = $conducteur;
    }

    public function changerCandidat(ConducteurInterface $conducteur): void
    {
        $this->candidat = $conducteur;
    }
    
    public function fairePasserExamen(): void
    {
        $this->candidat->demarrer();
        $this->candidat->accelerer();
        $this->candidat->tournerDroite();
        $this->candidat->accelerer();
        $this->candidat->tournerGauche();
        $this->candidat->ralentir();
        $this->candidat->reculer();
        $this->candidat->immobiliser();
    }
} 

interface ConducteurInterface
{
    public function demarrer(): void;
    public function tournerGauche(): void;
    public function tournerDroite(): void;
    public function accelerer(): void;
    public function ralentir(): void;
    public function reculer(): void;
    public function immobiliser(): void;
}
 
class Automobiliste implements ConducteurInterface
{
    public function demarrer(): void
    {
        echo "tourner la clé de contact ou mettre la carte";
    }
    
    public function tournerGauche(): void
    {
        echo "tourner le volant vers la gauche";
    }
    
    public function tournerDroite(): void
    {
        echo "tourner le volant vers la droite";
    }
    
    public function accelerer(): void
    {
        echo "appuyer sur la pédale d'accélération";
    }
    
    public function ralentir(): void
    {
        echo "relâcher la pédale d'accélération et/ou", 
                      "appuyer sur la pédale de frein";
    }
    
    public function reculer(): void
    {
        echo "passer la marche arrière et accélérer";
    }
    
    public function immobiliser(): void
    {
        echo "mettre le frein à main";
    }
}

interface NavigateurInterface
{
    public function demarrer(): void;
    public function reculer(): void;
    public function tournerBabord(): void;
    public function tournerTribord(): void;
    public function accelerer(): void;
    public function ralentir(): void;
    public function jeterAncre(): void;
}
 
abstract class Marin implements NavigateurInterface
{
    // méthode commune à tous les marins
    public function jeterAncre(): void
    {
        echo "jeter l'ancre à la mer".PHP_EOL;
    }
}

class MarinVoile extends Marin
{
    public function demarrer(): void
    {
        echo "Cette fonctionnalité n'est pas disponible".PHP_EOL;
    }
    
    public function tournerBabord(): void
    {
        echo "diriger les voiles et la barre pour aller à babord".PHP_EOL;
    }
    
    public function tournerTribord(): void
    {
        echo "diriger les voiles et la barre pour aller à tribord".PHP_EOL;
    }
    
    public function accelerer(): void
    {
        echo "positionner les voiles et déterminer l'allure".PHP_EOL;
    }
    
    public function ralentir(): void
    {
        echo "positionner les voiles et déterminer l'allure".PHP_EOL;
    }
    
    
    public function reculer(): void
    {
        echo "positionner les voiles et manœuvrer pour reculer".PHP_EOL;
    }
}
 
class MarinMoteur extends Marin
{
    public function demarrer(): void
    {
        echo "démarrer le moteur".PHP_EOL;
    }
    
    public function tournerBabord(): void
    {
        echo "manoeuvrer la barre ou le volant pour aller à babord".PHP_EOL;
    }
    
    public function tournerTribord(): void
    {
        echo "manoeuvrer la barre ou le volant pour aller à tribord".PHP_EOL;
    }
    
    public function accelerer(): void
    {
        echo "augmenter la vitesse du moteur".PHP_EOL;
    }
    
    public function ralentir(): void
    {
        echo "dimininuer la vitesse du moteur ou le couper".PHP_EOL;
    }
    
    public function reculer(): void
    {
        echo "passer la marche arrière".PHP_EOL;
    }
}

class AdaptateurMarin implements ConducteurInterface
{
    private $marin;
     
    public function __construct(NavigateurInterface $marin)
    {
        $this->marin = $marin;
    }
    
    public function demarrer(): void
    {
        $this->marin->demarrer();
    }
    
    public function tournerGauche(): void
    {
        $this->marin->tournerBabord();
    }
    
    public function tournerDroite(): void
    {
        $this->marin->tournerTribord();
    }
    
    public function accelerer(): void
    {
        $this->marin->accelerer();
    }
    
    public function ralentir(): void
    {
        $this->marin->ralentir();
    }
    
    public function reculer(): void
    {
        $this->marin->reculer();
    }
    
    public function immobiliser(): void
    {
        $this->marin->jeterAncre();
    }
}

$adaptateur = new AdaptateurMarin(new MarinMoteur());
$inspecteur = new InspecteurPermisConduire($adaptateur);
$inspecteur->fairePasserExamen();
$adaptateur = new AdaptateurMarin(new MarinVoile());
$inspecteur->changerCandidat($adaptateur);
$inspecteur->fairePasserExamen();
