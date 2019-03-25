<?php

interface FabriqueInterface
{
    public static function fabriquer(): FormeInterface;
}

interface FormeInterface
{
    public function dessiner(): void;
}

class Carre implements FormeInterface
{
    public function dessiner(): void
    {
        echo "Je dessine un carré".PHP_EOL;
    }
}

class Triangle implements FormeInterface
{
    public function dessiner(): void
    {
        echo "Je dessine un triangle".PHP_EOL;
    }
}

class FabriqueDeCarres implements FabriqueInterface
{
    public static function fabriquer(): FormeInterface
    {
        return new Carre();
    }
}

class FabriqueDeTriangles implements FabriqueInterface
{
    public static function fabriquer(): FormeInterface
    {
        return new Triangle();
    }
}

$carre = FabriqueDeCarres::fabriquer();
$carre->dessiner();

$triangle = FabriqueDeTriangles::fabriquer();
$triangle->dessiner();
