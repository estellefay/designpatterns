<?php

interface ImageInterface
{
    public function donnerTaille(): int;
    public function aContenu(): bool;
    public function afficherContenu(): ?string;
}

abstract class AbstractImage implements ImageInterface
{
	protected $cheminFichier;
	protected $contenuFichier;
	protected $tailleFichier;
	
	public function __construct($cheminFichier)
	{
		$this->cheminFichier = $cheminFichier;
	}
	
	public function donnerTaille(): int
	{
		return $this->tailleFichier;
	}
	
	public function aContenu(): bool
	{
		return null !== $this->contenuFichier;
	}
}

class StandardImage extends AbstractImage
{
	public function __construct($cheminFichier)
	{
		parent::__construct($cheminFichier);
		$this->contenuFichier = file_get_contents(
                                          $this->cheminFichier);
		$this->tailleFichier = filesize(
                                          $this->cheminFichier);
	}
	
	public function afficherContenu(): ?string
	{
		return $this->contenuFichier;
	}
}

class ProxyImage extends AbstractImage {
	
	private $vraieImage;
	
	public function __construct($cheminFichier)
	{
		parent::__construct($cheminFichier);
		$this->tailleFichier = filesize($this->cheminFichier);
	}
	
	public function afficherContenu(): ?string
	{
		if (!$this->vraieImage) {
			$this->vraieImage = new StandardImage(
                                              $this->cheminFichier);
		}
		
		return $this->vraieImage->afficherContenu();
	}
}

final class GestionnaireImage
{
	public function traiterImage (ImageInterface $image): void
	{
		echo $image->donnerTaille() . ' octets';
		echo 'Contenu présent ?'.($image->aContenu());
		echo $image->afficherContenu();
	}
}

$gestionnaireImage = new GestionnaireImage();
$cheminImage = __DIR__.'/elephpant.png';

$image = new StandardImage($cheminImage);
echo $gestionnaireImage->traiterImage($image);

$proxy = new ProxyImage($cheminImage);
echo $gestionnaireImage->traiterImage($proxy);
