<?php

namespace App\Http\Entity;

class Pais{
    public readonly int $id;
    public readonly string $nome;
    public readonly string $sigla;

    public function __construct(
        string $nome,
        string $sigla
    ) {
        $this->nome = $nome;
        $this->validaSigla($sigla);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    private function validaSigla(string $sigla): void 
    {
        if(strlen($sigla) !== 3 && $sigla != null) {
            throw new \InvalidArgumentException('Sigla precisa ter 3 caracteres.');
        }

        $this->sigla = $sigla;
    }

    public function __toString(): string {
        return "{$this->sigla} - {$this->nome}";
    }
}
