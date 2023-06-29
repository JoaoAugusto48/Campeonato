<?php

namespace App\Http\Entity;

class Campeonato{
    public readonly int $id;
    public readonly string $nome;
    public readonly int $turno;
    public readonly int $qtdeEquipe;

    public function __construct(string $nome, int $turno, int $qtdeEquipe ) 
    {
        $this->nome = $nome;
        $this->turno = $turno;
        $this->qtdeEquipe = $qtdeEquipe;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}
