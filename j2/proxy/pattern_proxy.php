<?php

interface PersonneInterface
{
    public function parlerDuTemps(): string;
}

interface PresidentInterface extends PersonneInterface
{
    public function parlerDuRechauffementClimatique(): string;
    public function parlerDesGuerres(): string;
}
 
final class PresidentRusse implements PresidentInterface
{
    public function parlerDuTemps(): string
    {
        return 'Я очень рад быть здесь, погода прекрасная в Париже';
    }

    public function parlerDuRechauffementClimatique(): string
    {
        return 'это очень серьезная проблема !';
    }

    public function parlerDesGuerres(): string
    {
        return 'какая война?';
    }
}

interface InterpreteInterface
{
    public function boireUnVerreEau(): string;
}

abstract class Interprete implements InterpreteInterface
{
    protected $presidentHote;
    
    protected $presidentInvite;

    public function __construct(PresidentInterface $presidentHote, PresidentInterface $presidentInvite)
    {
        $this->presidentHote = $presidentHote;
        $this->presidentInvite = $presidentInvite;
    }
    
    public function boireUnVerreEau(): string
    {
        return 'Glou Glou Glou'.PHP_EOL;
    }
}
 
class InterpreteRusse extends Interprete implements PresidentInterface
{
    public function parlerDuTemps(): string
    {
        $temps = 'Au sujet du temps, le président russe me dit : "';
        $temps .= $this->presidentInvite->parlerDuTemps().'"'.PHP_EOL;
        
        return $temps;
    }

    public function parlerDuRechauffementClimatique(): string
    {
        $climat = 'Au sujet du réchauffement climatique, le président russe me dit : "';
        $climat .= $this->presidentInvite->parlerDuRechauffementClimatique().'"'.PHP_EOL;
        
        return $climat;
    }

    public function parlerDesGuerres(): string
    {
        if ($this->presidentHote instanceof PresidentFrancais) {
            return 'Le président russe ne souhaite pas évoquer le sujet avec le président français ! Prenons plutôt Vodka !'.PHP_EOL;
        }
        
        $guerre = 'Au sujet des guerres, le président russe me dit : "';
        $guerre .= $this->presidentInvite->parlerDesGuerres().'"'.PHP_EOL;
        
        return $guerre;
    }
}
 
final class PresidentFrancais implements PresidentInterface
{
    private $interprete;
     
    public function attacherInterprete(InterpreteInterface $interprete): void
    {
        $this->interprete = $interprete;
    }
    
    public function parlerDuTemps(): string
    {
        return 'Président, il fait bon vivre à Paris, hein ?'.PHP_EOL;
    }

    public function parlerDuRechauffementClimatique(): string
    {
        return 'Que pensez-vous du réchauffement climatique ?'.PHP_EOL;
    }

    public function parlerDesGuerres(): string
    {
        return 'Que vous inspirent les conflits mondiaux ?'.PHP_EOL;
    }
    
    public function discuterSurPerron(): void
    {
        if (!$this->interprete) {
            throw new RuntimeException('Où est l\'interprète ?');
        }
         
        echo $this->parlerDuTemps();
        echo $this->interprete->parlerDuTemps();
        
        echo $this->parlerDuRechauffementClimatique();
        echo $this->interprete->parlerDuRechauffementClimatique();
        
        echo $this->parlerDesGuerres();
        echo $this->interprete->parlerDesGuerres();
    }
}
 
$presidentFrancais = new PresidentFrancais();
$presidentRusse = new PresidentRusse();
$InterpreteRusse = new InterpreteRusse($presidentFrancais, $presidentRusse);

$presidentFrancais->attacherInterprete($InterpreteRusse);
 
try {
    $presidentFrancais->discuterSurPerron();
} catch (RuntimeException $exception) {
    echo "Allô, ici le chef du protocole !", PHP_EOL;
    echo "Le président vient de me dire '" . 
              $exception->getMessage(), "'", PHP_EOL;
    echo "Vite, allez chercher un interprète !", PHP_EOL;
}

echo $InterpreteRusse->boireUnVerreEau();

