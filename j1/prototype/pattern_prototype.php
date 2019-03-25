<?php

abstract class Humain
{   
    protected $prenom;
    
    protected $sexe;
        
    public function __construct(string $prenom)
    {
        $this->prenom = $prenom;
    }
    
    public function donnerSexe(): string
    {
        return $this->sexe; 
    }
    
    public function changerPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }
    
    public function donnerPrenom(): string
    {
        return $this->prenom; 
    }
    
    abstract public function __clone();
}

class Male extends Humain
{
    protected $sexe = 'M';

    public function __clone()
    {
    }
}

class Femelle extends Humain
{
    protected $sexe = 'F';
    
    public function __clone()
    {
    }
}

$prenoms = [
        'René', 'Eric', 'Jean', 'Robert', 'Marius',
        'Kevin', 'Léo', 'Jacques', 'Loïc', 'John',
        'Alexis', 'Kenneth', 'Nathanaël', 'Christophe'
    ];
    
$male1 = new Male('Rrrnnngrrwggl');

$numeroClone = 0;
$clones = [];

foreach ($prenoms as $prenom) {
    ++$numeroClone;
    
    $nomClone = 'clone'.$numeroClone;
    $$nomClone = clone $male1;
    $$nomClone->changerPrenom($prenom);
    $clones[] = $$nomClone;
}

$prenoms = [
        'Lise', 'Marie', 'Ninon', 'Rachida', 'Ana',
        'Martine', 'Svetlana', 'Eve', 'Carole',
        'Sylvie', 'Laurie', 'Zhang', 'Fatoumata'
    ];

$femelle1 = new Femelle('Nyyyynyaaa');
    
foreach ($prenoms as $prenom) {
    ++$numeroClone;
    
    $nomClone = 'clone'.$numeroClone;
    $$nomClone = clone $femelle1;
    $$nomClone->changerPrenom($prenom);
    $clones[] = $$nomClone;
}

foreach ($clones as $clone) {
    echo $clone->donnerSexe().'/'.$clone->donnerPrenom().PHP_EOL;
}
