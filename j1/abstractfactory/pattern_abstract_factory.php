<?php

interface ProduitEntretienInterface
{
    public function pointsDeVente(): array;
}

abstract class ProduitEntretien implements ProduitEntretienInterface
{
    protected $caracteristiques;
    
    public function __construct(array $caracteristiques)
    {
        $this->caracteristiques = $caracteristiques;
    }
}

class LessiveIndustrielle extends ProduitEntretien
{
    public function pointsDeVente(): array
    {
        return ['Grande Distribution'];
    }
}

class ProduitVaisselleIndustriel extends ProduitEntretien
{
    public function pointsDeVente(): array
    {
        return ['Grande Distribution'];
    }
}

class LessiveEcologique extends ProduitEntretien
{
    public function pointsDeVente(): array
    {
        return ['Grande Distribution', 'Supérettes Bio', 'Marchés'];
    }
}

class ProduitVaisselleEcologique extends ProduitEntretien
{
    public function pointsDeVente(): array
    {
        return ['Supérettes Bio', 'Marchés'];
    }
}

interface FabriqueProduitEntretienInterface
{
    public function fabriquerLessive(): ProduitEntretienInterface;
    public function fabriquerProduitVaisselle(): ProduitEntretienInterface;
}

class FabriqueProduitEntretienEcologique implements FabriqueProduitEntretienInterface
{
    public function fabriquerLessive(): ProduitEntretienInterface
    {
        return new LessiveEcologique(['tensioactifs' => 'naturels', 'colorants' => 'naturels', 'parfum' => 'huiles essentielles']);
    }

    public function fabriquerProduitVaisselle(): ProduitEntretienInterface
    {
        return new ProduitVaisselleEcologique(['base' => 'savon Marseille', 'additifs' => ['soude', 'vinaigre']]);
    }
}

class FabriqueProduitEntretienIndustriel implements FabriqueProduitEntretienInterface
{
    public function fabriquerLessive(): ProduitEntretienInterface
    {
        return new LessiveIndustrielle(['tensioactifs' => 'chimiques', 'colorants' => 'chimiques', 'parfum' => 'synthétiques']);
    }

        public function fabriquerProduitVaisselle(): ProduitEntretienInterface
    {
        return new ProduitVaisselleIndustriel(['tensioactifs' => 'chimiques', 'colorants' => 'chimiques', 'parfum' => 'synthétiques']);
    }
}

$fabriqueIndustrielle = new FabriqueProduitEntretienIndustriel();
$lessiveIndustrielle = $fabriqueIndustrielle->fabriquerLessive();
$produitVaisselleIndustriel = $fabriqueIndustrielle->fabriquerProduitVaisselle();

$fabriqueEcologique = new FabriqueProduitEntretienEcologique();
$lessiveEcologique = $fabriqueEcologique->fabriquerLessive();
$produitVaisselleEcologique = $fabriqueEcologique->fabriquerProduitVaisselle();

var_dump($produitVaisselleIndustriel);
var_dump($produitVaisselleEcologique);
