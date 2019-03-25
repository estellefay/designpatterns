<?php

interface FabriqueInterface
{
    public function fabriquer(): FormeInterface;
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

class Cercle implements FormeInterface
{
    public function dessiner(): void
    {
        echo "Je dessine un Cercle".PHP_EOL;
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
    public function fabriquer(): FormeInterface
    {
        return new Carre();
    }
}

class FabriqueDeTriangles implements FabriqueInterface
{
    public function fabriquer(): FormeInterface
    {
        return new Triangle();
    }
}

class FabriqueDeCercles implements FabriqueInterface
{
    public function fabriquer(): FormeInterface
    {
        return new Cercle();
    }
}
/*
$fabrique = new FabriqueDeCarres();
$carre = $fabrique->fabriquer();
$carre->dessiner();

$fabrique = new FabriqueDeTriangles();
$triangle = $fabrique->fabriquer();
$triangle->dessiner();
*/
/*
class Dessinateur
{
    public function dessinerForme(FabriqueInterface $fabriqueDeFormes)
    {
        $forme = $fabriqueDeFormes->fabriquer();
        $forme->dessiner();
    }
}

$dessinateur = new Dessinateur();
$dessinateur->dessinerForme(new FabriqueDeCercles());
*/

class Dessinateur
{
    public function dessinerForme(array $fabriquesDeFormes)
    {
        foreach($fabriquesDeFormes as $fabriqueDeFormes) {
            $forme = $fabriqueDeFormes->fabriquer();
            $forme->dessiner();
        }
    }
}

$fabriquesDeFormes = [
    new FabriqueDeTriangles(),
    new FabriqueDeCercles(),
    new FabriqueDeCarres(),
];

$dessinateur = new Dessinateur();
$dessinateur->dessinerForme($fabriquesDeFormes);
