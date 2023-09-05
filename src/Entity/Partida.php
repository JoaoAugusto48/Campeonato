<?php

namespace App\Http\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('partidas')]
class Partida
{
    #[Id, GeneratedValue, Column]
    public ?int $id;
    #[Column('campeonatos_id')]
    public int $campeonatoId;
    #[Column('time_casa')]
    public int $timeCasaId;
    #[Column('time_visitante')]
    public int $timeVisitanteId;
    #[Column('num_gols_casa')]
    public int $numGolCasa;
    #[Column('num_gols_visitante')]
    public int $numGolVisitante;
    #[Column]
    public int $rodada;
    #[Column]
    public ?bool $status;
    #[ManyToOne(
        targetEntity: Equipe::class,
        inversedBy: 'partidas',
        // fetch: 'EAGER'
    )]
    #[JoinColumn(name: 'time_casa', referencedColumnName: 'id')]
    public ?Equipe $timeCasa;
    #[ManyToOne(
        targetEntity: Equipe::class,
        inversedBy: 'partidas',
        // fetch: 'EAGER'
    )]
    #[JoinColumn(name: 'time_visitante', referencedColumnName: 'id')]
    public ?Equipe $timeVisitante;
    
    public function __construct(
        int $campeonatoId,
        int $timeCasaId,
        int $timeVisitanteId,
        int $rodada,
        ?int $numGolCasa = null,
        ?int $numGolVisitante = null,
        ?int $id = null,
        ?bool $status = true,
        ?Equipe $timeCasa = null,
        ?Equipe $timeVisitante = null,
    ) 
    {
        $this->campeonatoId = $campeonatoId;
        $this->timeCasaId = $timeCasaId;
        $this->timeVisitanteId = $timeVisitanteId;
        $this->rodada = $rodada;
        $this->numGolCasa = $numGolCasa;
        $this->numGolVisitante = $numGolVisitante;
        $this->status = $status;
        $this->id = $id;
        
        $this->timeCasa = $timeCasa;
        $this->timeVisitante = $timeVisitante;
    } 
    
}
