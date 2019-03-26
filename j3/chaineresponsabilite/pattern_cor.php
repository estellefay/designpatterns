<?php

interface EvenementInterface
{
    public function donnerContenu();
}

abstract class EvenementAbstract implements EvenementInterface
{
    protected $contenu;
    
    public function __construct($contenu)
    {
        $this->contenu = $contenu;
    }
}

class Achat extends EvenementAbstract
{   
    public function donnerContenu()
    {
        return $this->contenu;
    }
}

class Inscription extends EvenementAbstract
{
    public function donnerContenu()
    {
        return $this->contenu;
    }
}

class Paiement extends EvenementAbstract
{
    public function donnerContenu()
    {
        return $this->contenu;
    }
}

class Requete
{
    private $evenement;
    
    public function __construct(EvenementInterface $evenement)
    {
        $this->evenement = $evenement;
    }
    
    public function donnerEvenement()
    {
        return $this->evenement;
    }
}

interface GestionnaireInterface
{
    public function traiterRequete(Requete $requete): void;
    public function changerSuccesseur(GestionnaireInterface $gestionnaire): void;
}

abstract class GestionnaireAbstract implements GestionnaireInterface
{
    protected $successeur;
    
    public function changerSuccesseur(GestionnaireInterface $successeur): void
    {
        $this->successeur = $successeur;
    }
    
    abstract protected function saitTraiter(Requete $requete): bool;
}

class GestionnaireAchat extends GestionnaireAbstract
{
    public function traiterRequete(Requete $requete): void
    {
        $evenement = $requete->donnerEvenement();
        $nom = $evenement->donnerContenu()['nom'];
        
        if ($this->saitTraiter($requete)) {
            echo "Je prends l'achat de $nom en charge !".PHP_EOL;
            return;
        }
        
        echo "Ce n'est pas un achat, je passe !".PHP_EOL;
        
        if ($this->successeur) {
            $this->successeur->traiterRequete($requete);
        }
    }

    protected function saitTraiter(Requete $requete): bool
    {
        return ($requete->donnerEvenement() instanceof Achat);
    }
}

class GestionnaireInscription extends GestionnaireAbstract
{
    public function traiterRequete(Requete $requete): void
    {
        $evenement = $requete->donnerEvenement();
        $nom = $evenement->donnerContenu()['nom'];
        
        if ($this->saitTraiter($requete)) {
            echo "Je traite l'inscription de $nom !".PHP_EOL;
            return;
        }
        
        echo "Ce n'est pas une inscription, je passe !".PHP_EOL;
        
        if ($this->successeur) {
            $this->successeur->traiterRequete($requete);
        }
    }
    
    protected function saitTraiter(Requete $requete): bool
    {
        return ($requete->donnerEvenement() instanceof Inscription);
    }
}

class GestionnaireParDefaut extends GestionnaireAbstract
{
    public function traiterRequete(Requete $requete): void
    {
        $evenement = $requete->donnerEvenement();       
        echo get_class($evenement).": impossible à traiter !".PHP_EOL;
    }
    
    protected function saitTraiter(Requete $requete): bool
    {
        return false;
    }
}

class ChaineDeGestionnaires
{
    private $gestionnaires = [];

    public function __construct(array $gestionnaires)
    {
        for ($i = 0; $i < count($gestionnaires); $i++) {
            $successeur = ($i == count($gestionnaires)-1) ? new GestionnaireParDefaut() : $gestionnaires[$i+1];
            $gestionnaires[$i]->changerSuccesseur($successeur);
        }

        $this->gestionnaires = $gestionnaires;
    }

    public function traiterRequete(Requete $requete)
    {
        $this->gestionnaires[0]->traiterRequete($requete);
    }
}

$chaine = new ChaineDeGestionnaires([new GestionnaireAchat(), new GestionnaireInscription()]);

$evenements = [
    new Achat(['nom' => 'Dentifrice', 'prix' => 2, 'qte' => 1]),
    new Inscription(['nom' => 'Ferrandez', 'prenom' => 'Sébastien']),
    new Paiement(['nom' => 'Paypal', 'montant' => 12.34]),
];

foreach ($evenements as $evenement) {
    echo get_class($evenement).PHP_EOL;
    $requete = new Requete($evenement);
    $chaine->traiterRequete($requete);
}