<?php
/*
interface FabriqueInterface
{
    public static function fabriquer(array $parametres, string $type): ConnexionInterface;
}
*/
interface ConnexionInterface
{
    public function connecter(): void;
}

class ConnexionMysql implements ConnexionInterface
{
    private $parametres;

    private $connexion;

    public function __construct(array $parametres)
    {
        $this->parametres = $parametres;
    }
       
    public function connecter(): void
    {
        $dsn = 'mysql:dbname='.$this->parametres['db'].';host='.$this->parametres['ip'];
        $this->connexion = new PDO($dsn, $this->parametres['usr'], $this->parametres['pwd']);
        //var_dump($this->connexion->getAttribute(PDO::ATTR_CONNECTION_STATUS));
    }
}

class FabriqueDeConnexions implements FabriqueInterface
{
    public static function fabriquer(array $parametres, string $type): ConnexionInterface
    {
        switch (strtolower($type)) {
            case 'mysql':
                return new ConnexionMysql($parametres);
            // default est optionnel
        }
    }
}

$parametres = [
    'db' => 'symfony',
    'ip' => '127.0.0.1',
    'usr' => 'root',
    'pwd' => 'abcd',    
];

$connexionMysql = FabriqueDeConnexions::fabriquer($parametres, 'mysql');
$connexionMysql->connecter();

interface FabriqueInterface
{
    public static function fabriquer(array $parametres): ConnexionInterface;
}

class FabriqueDeConnexionsMySQL implements FabriqueInterface
{
    public static function fabriquer(array $parametres): ConnexionInterface
    {
        return new ConnexionMysql($parametres);
    }
}

$connexionMysql = FabriqueDeConnexionsMySQL::fabriquer($parametres);
$connexionMysql->connecter();
