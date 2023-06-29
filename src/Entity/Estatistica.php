<?php

namespace App\Http\Entity;

use App\Http\Entity\Campeonato;
use App\Http\Entity\Equipe;

class Estatistica{
    public readonly int $id;
    public readonly int $vitorias;
    public readonly int $empates;
    public readonly int $derrotas;
    public readonly int $golsPro;
    public readonly int $golsContra;
    public readonly int $pontos; // criado apenas para mostrar os pontos

    public readonly int $equipeId;
    public readonly int $campeonatoId;

    public readonly Campeonato $campeonato;
    public readonly Equipe $equipe;
    
    public function __construct(
        int $vitorias,
        int $empates,
        int $derrotas,
        int $golsPro,
        int $golsContra,
        int $pontos,
        int $campeonatoId,
        Equipe $equipe,
    ){
        $this->vitorias = $vitorias;
        $this->empates = $empates;
        $this->derrotas = $derrotas;
        $this->golsPro = $golsPro;
        $this->golsContra = $golsContra;
        $this->pontos = $pontos;
        $this->campeonatoId = $campeonatoId;
        $this->equipe = $equipe;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}
