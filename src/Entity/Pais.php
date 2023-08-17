<?php

namespace App\Http\Entity;

final class Pais
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;

    public function __construct(string $nome, string $sigla, ?int $id = null) 
    {
        $this->nome = $nome;
        $this->sigla = $this->configureSigla($sigla);
        $this->id = $id;
    }
    
    public static function fromArray(array $paisData, string $nome = 'nome', string $sigla = 'sigla', ?string $id = 'id'): Pais
    {
        return new Pais(
            $paisData[$nome], 
            $paisData[$sigla], 
            id: $paisData[$id]
        );
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
