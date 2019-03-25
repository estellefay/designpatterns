<?php

abstract class Voiture
{   
    protected $marque;
    
    protected $taille;
       
    public function donnerTaille(): string
    {
        return $this->taille; 
    }
    
    public function changerTaille(string $taille): void
    {
        $this->taille = $taille;
    }
    
    abstract public function __clone();
}

class Mercedes extends Voiture
{
    protected $marque = 'Mercedes';

    public function __construct()
    {
        $this->taille = 'Grande';
        echo "Je fais tout un tas de choses super compliquées...".PHP_EOL;
    }
    
    public function __clone()
    {
        echo "je court-circuite le construct, on y fait des choses trop complexes !".PHP_EOL;
    }
}

// le prototype, on va le cloner à volonté !
$mercedes = new Mercedes();

// le clone, qu'on modifie
$maquetteMercedes = clone $mercedes;
$maquetteMercedes->changerTaille('Miniature');

var_dump($mercedes);
var_dump($maquetteMercedes);
