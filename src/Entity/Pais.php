<?php

namespace App\Http\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Pais
{
    #[Id, GeneratedValue, Column]
    public ?int $id;
    #[Column(length: 25)]
    public string $nome;
    #[Column(length: 3)]
    public string $sigla;
    #[Column]
    public bool $status;

    public function __construct(string $nome, string $sigla, ?int $id = null) 
    {
        $this->nome = $nome;
        $this->sigla = $this->configureSigla($sigla);
        $this->id = $id;
    }

    public function paisEncode(): string 
    {
        return htmlspecialchars(json_encode($this));
    }

    public static function paisDecode(string $stringPais): Pais
    {
        $paisData = json_decode($stringPais, true);
        return new Pais($paisData['nome'], $paisData['sigla'], $paisData['id']);
    }

    private function configureSigla(string $sigla): string
    {
        return strtoupper($sigla); 
    }

    public function __toString(): string 
    {
        return "{$this->sigla} - {$this->nome}";
    }

}
