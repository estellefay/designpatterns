<?php

/**
    Le supertype du composant, ici une interface (peut également être une classe abstraite)
*/
interface VehiculeInterface
{
    public function getPrix(): float;
    public function getDescription(): string;
}

/**
    Un composant concret
*/
final class Coccinelle implements VehiculeInterface
{
    private $description = 'Volkswagen Coccinelle';
    
    private $prix = 14000;
    
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function getPrix(): float
    {
        return $this->prix;
    }
}

/**
    Notre décorateur abstrait, qui se conforme au supertype de son composant
*/
abstract class DecorateurOption implements VehiculeInterface
{
    // variable d'instance contenant l'objet décoré
    protected $vehicule;
    
    public function __construct(VehiculeInterface $vehicule)
    {
        $this->vehicule = $vehicule;
    }
}

/**
    Un décorateur concret
*/
final class OptionPeintureMetallisee extends DecorateurOption
{
    // l'état de notre objet est enrichi
    private $couleur;
    
    public function getDescription(): string
    {
        // le comportement de base de nos décorateurs peinture est enrichi par l'appel à une
        // méthode privée après la délégation de l'invocation d'une méthode à notre composant
        return $this->vehicule->getDescription().$this->getDescriptionPeinture();
    }
    
    public function getPrix(): float
    {
        return $this->vehicule->getPrix()+2000;
    }
    
    public function setCouleur(string $couleur): void
    {
        $this->couleur = $couleur;
    }
    
    private function getDescriptionPeinture(): string
    {
        return ', Peinture métallisée '.$this->couleur;
    }
}

/**
    Un autre décorateur concret
*/
final class OptionToitOuvrant extends DecorateurOption
{
    public function getDescription(): string
    {
        return $this->vehicule->getDescription().', Toit Ouvrant';
    }
    
    public function getPrix(): float
    {
        return $this->vehicule->getPrix()+700.49;
    }
}

/**
    L'utilisation à l'exécution de notre décorateur
*/

$coccinelle = new Coccinelle();
$coccinelleMetallisee = new OptionPeintureMetallisee($coccinelle);
$coccinelleMetallisee->setCouleur('vert');
$coccinelleMetalliseeToitOuvrant = new OptionToitOuvrant($coccinelleMetallisee);
$coccinelleToitOuvrant = new OptionToitOuvrant($coccinelle);

// objet décoré de deux options
echo $coccinelleMetalliseeToitOuvrant->getDescription().' : '.$coccinelleMetalliseeToitOuvrant->getPrix().' €'.PHP_EOL;
// objet de base
echo $coccinelle->getDescription().' : '.$coccinelle->getPrix().' €'.PHP_EOL;
// objet décoré de l'option peinture
echo $coccinelleMetallisee->getDescription().' : '.$coccinelleMetallisee->getPrix().' €'.PHP_EOL;
// objet décoré de l'option toit ouvrant
echo $coccinelleToitOuvrant->getDescription().' : '.$coccinelleToitOuvrant->getPrix().' €'.PHP_EOL;
