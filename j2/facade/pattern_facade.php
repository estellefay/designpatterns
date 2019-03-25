<?php

interface MettableSousTentionInterface
{
    public function mettreSousTension(): void;
}

interface CarteMereInterface extends MettableSousTentionInterface
{
    public function executerBIOS(): void;
}

interface EcranInterface extends MettableSousTentionInterface
{
    public function modifierLuminosite(): void;
}

interface DisqueDurInterface extends MettableSousTentionInterface
{
    public function amorcer(): void;
}

interface OSInterface
{
    public function donnerNumeroSerie(): void;
    public function charger(): void;
}

class MaCarteMere implements CarteMereInterface
{
    public function mettreSousTension(): void
    {
        echo "CM sous tension".PHP_EOL;
    }
    
    public function executerBIOS(): void
    {
        echo "exécution du BIOS".PHP_EOL;
    }
}

class MonEcran implements EcranInterface
{
    public function mettreSousTension(): void
    {
        echo "Ecran sous tension".PHP_EOL;
    }
    
    public function afficherInfos(): void
    {
        echo "Affichage des infos".PHP_EOL;
    }
    
    public function modifierLuminosite(): void
    {
        echo "Modification de la luminosité".PHP_EOL;
    }
}

class MonDisqueDur implements DisqueDurInterface
{
    public function mettreSousTension(): void
    {
        echo "DD sous tension".PHP_EOL;
    }
    
    public function amorcer(): void
    {
        echo "DD amorcé".PHP_EOL;
    }
}

class MonOS implements OSInterface
{
    public function donnerNumeroSerie(): void
    {
        echo "Mon numéro de série".PHP_EOL;
    }
    
    public function charger(): void
    {
        echo "Chargement de l'OS".PHP_EOL;
    }
}

class OrdinateurFacade
{   
    private $carteMere;
    
    private $ecran;
    
    private $disqueDur;
    
    private $systemeExploitation;
    
    
    public function __construct(CarteMereInterface $carteMere, EcranInterface $ecran, DisqueDurInterface $disqueDur, OSInterface $systemeExploitation)
    {
        $this->carteMere = $carteMere;
        $this->ecran = $ecran;
        $this->disqueDur = $disqueDur;
        $this->systemeExploitation = $systemeExploitation;
    }
    
    public function mettreEnMarche(): void
    {
        $this->carteMere->mettreSousTension();
        $this->ecran->mettreSousTension();
        $this->carteMere->executerBIOS();
        $this->disqueDur->amorcer();
        $this->ecran->afficherInfos();
        $this->systemeExploitation->charger();
    }
}

$carteMere = new MaCarteMere();
$ecran = new MonEcran();
$disqueDur = new MonDisqueDur();
$systemeExploitation = new MonOS();

$facade = new OrdinateurFacade($carteMere, $ecran, $disqueDur, $systemeExploitation);

$facade->mettreEnMarche();
