<?php

namespace App\Http\Entity;
    
class Partida{
    public readonly int $id;
    public readonly int $campeonatoId;
    public readonly Equipe $timeCasa;
    public readonly Equipe $timeVisitante;
    public readonly int $nGolCasa;
    public readonly int $nGolVisitante;
    public readonly int $rodada;
    public readonly bool $status;

    public function __construct() 
    {

    } 

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
}
