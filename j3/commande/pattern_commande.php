<?php

// les récepteurs
interface OrdreInterface
{
	public function afficherLigneResume(): void;
}

interface OrdreAchatInterface
{
	public function acheter(): void;
}

interface OrdreVenteInterface
{
	public function vendre(): void;
}

abstract class OrdreAbstract
{
	protected $montant;

	public function __construct(float $montant)
	{
		$this->montant = $montant;
	}
}

class OrdreAchat extends OrdreAbstract implements OrdreInterface, OrdreAchatInterface
{
	public function acheter(): void
	{
		echo "Achat pour ".$this->montant." euros".PHP_EOL;
	}

	public function afficherLigneResume(): void
	{
		echo "ORD-ACH/".$this->montant.PHP_EOL;
	}
}

class OrdreVente extends OrdreAbstract implements OrdreInterface, OrdreVenteInterface
{
	public function vendre(): void
	{
		echo "Vente pour ".$this->montant." euros".PHP_EOL;
	}

	public function afficherLigneResume(): void
	{
		echo "ORD-VTE/".$this->montant.PHP_EOL;
	}
}

// les commandes
interface CommandeInterface
{
	public function executer(): void;
}

class AcheterStockCommande implements CommandeInterface
{
	private $ordre;

	public function __construct(OrdreInterface $ordre)
	{
		$this->ordre = $ordre;
	}

	public function executer(): void
	{
		$this->ordre->acheter();
	}	
}

class VendreStockCommande implements CommandeInterface
{
	private $ordre;

	public function __construct(OrdreAbstract $ordre)
	{
		$this->ordre = $ordre;
	}

	public function executer(): void
	{
		$this->ordre->vendre();
	}	
}

// l'invocateur
class Trader
{
	private $commande;

	public function __construct(CommandeInterface $commande)
	{
		$this->commande = $commande;
	}

	public function executerCommande(): void
	{
		$this->commande->executer();
	}

	public function changerCommande(CommandeInterface $commande): void
	{
		$this->commande = $commande;
	}
}

// le client
$ordre = new OrdreAchat(120);
$commande = new AcheterStockCommande($ordre);
$trader = new Trader($commande);
$trader->executerCommande();

$ordre = new OrdreVente(600);
$commande = new VendreStockCommande($ordre);
$trader->changerCommande($commande);
$trader->executerCommande();