<?php

interface CancaneurInterface
{
    public function cancaner(): string;
}

class Canard implements CancaneurInterface
{
    public function cancaner(): string
    {
        return 'Coincoin';
    }
}

interface AnimalPlastiqueInterface
{
    public function emettreUnSon(): string;
}

class CanardEnPlastique implements AnimalPlastiqueInterface
{
    public function emettreUnSon(): string
    {
        return 'Pouic';
    }
}

class AdaptateurDeCanard implements CancaneurInterface
{
    private $adapte;

    public function __construct(CanardEnPlastique $canard)
    {
        $this->adapte = $canard;
    }
    
    public function cancaner(): string
    {
        return $this->adapte->emettreUnSon();
    }
}

$adaptateurs = [
                new AdaptateurDeCanard(new CanardEnPlastique()),
                new Canard(),
                ];

foreach ($adaptateurs as $adaptateur) {
    echo $adaptateur->cancaner().PHP_EOL;
}

