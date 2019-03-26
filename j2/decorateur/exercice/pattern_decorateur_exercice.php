<?php

/**
    Le supertype du composant, ici une interface (peut également être une classe abstraite)
*/
interface BurgerInterface
{
    public function getPrix(): float;
    public function getDescription(): string;
}

/**
    Deux composants concrets
*/
final class Burger implements BurgerInterface
{   
    public function getDescription(): string
    {
        return 'Steak, Cheddar';
    }
    
    public function getPrix(): float
    {
        return 2;
    }
}

final class BurgerVeggie implements BurgerInterface
{   
    public function getDescription(): string
    {
        return 'Steak de tofu, fauxmage';
    }
    
    public function getPrix(): float
    {
        return 2.8;
    }
}

/**
    Notre décorateur abstrait, qui se conforme au supertype de son composant
*/
abstract class DecorateurIngredientBurger implements BurgerInterface
{
    // variable d'instance contenant l'objet décoré
    protected $decore;
    
    public function __construct(BurgerInterface $burger)
    {
        $this->decore = $burger;
    }
}

/**
    Un décorateur concret
*/
final class ExtraBacon extends DecorateurIngredientBurger
{   
    public function getDescription(): string
    {
        return $this->decore->getDescription().', Bacon';
    }
    
    public function getPrix(): float
    {
        return $this->decore->getPrix()+0.5;
    }

    // ici on écrase le constructeur hérité avec un nouveau qui s'assure de la présence d'un burger non végétarien
    public function __construct(BurgerInterface $burger)
    {
        if ($burger instanceof BurgerVeggie) {
            throw new LogicException('Hop hop hop, pas de viande ici, c\'est un burger végé !');
        }

        parent::__construct($burger);
    }
}

final class ExtraCornichon extends DecorateurIngredientBurger
{   
    public function getDescription(): string
    {
        return $this->decore->getDescription().', Cornichons';
    }
    
    public function getPrix(): float
    {
        return $this->decore->getPrix()+0.5;
    }
}

/**
    L'utilisation à l'exécution de notre décorateur
*/

$burger = new Burger();
$burgerBacon = new ExtraBacon($burger);
$burgerCornichonBacon = new ExtraCornichon($burgerBacon);

$burgerCornichon = new ExtraCornichon($burger);

// Burger avec un ingrédient rajouté
echo $burgerCornichon->getDescription().' : '.$burgerCornichon->getPrix().' €'.PHP_EOL;
// Burger avec deux ingrédients rajoutés
echo $burgerCornichonBacon->getDescription().' : '.$burgerCornichonBacon->getPrix().' €'.PHP_EOL;

$burgerVeggie = new BurgerVeggie();
$burgerVeggieCornichon = new ExtraCornichon($burgerVeggie);
echo $burgerVeggieCornichon->getDescription().' : '.$burgerVeggieCornichon->getPrix().' €'.PHP_EOL;

try {
    $burgerVeggieBacon = new ExtraBacon($burgerVeggie);
} catch (\Throwable $exception)
{
    echo "Problème : ".$exception->getMessage().PHP_EOL;
}
