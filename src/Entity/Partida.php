<?php

namespace App\Http\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('partidas')]
class Partida
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id;
    #[ORM\Column('campeonatos_id')]
    private int $campeonatoId;
    #[ORM\Column('time_casa')]
    private int $timeCasaId;
    #[ORM\Column('time_visitante')]
    private int $timeVisitanteId;
    #[ORM\Column('num_gols_casa')]
    private int $numGolCasa;
    #[ORM\Column('num_gols_visitante')]
    private int $numGolVisitante;
    #[ORM\Column]
    private int $rodada;
    #[ORM\Column]
    private ?bool $status;

    #[ORM\ManyToOne(
        targetEntity: Equipe::class,
        inversedBy: 'partidas',
        // fetch: 'EAGER'
    )]
    #[ORM\JoinColumn(name: 'time_casa', referencedColumnName: 'id')]
    private ?Equipe $timeCasa;

    #[ORM\ManyToOne(
        targetEntity: Equipe::class,
        inversedBy: 'partidas',
        // fetch: 'EAGER'
    )]
    #[ORM\JoinColumn(name: 'time_visitante', referencedColumnName: 'id')]
    private ?Equipe $timeVisitante;

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
    ) {
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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCampeonatoId(): int
    {
        return $this->campeonatoId;
    }

    public function setCampeonatoId(int $campeonatoId): void
    {
        $this->campeonatoId = $campeonatoId;
    }

    public function getTimeCasaId(): int
    {
        return $this->timeCasaId;
    }

    public function setTimeCasaId(int $timeCasaId): void
    {
        $this->timeCasaId = $timeCasaId;
    }

    public function getTimeVisitanteId(): int
    {
        return $this->timeVisitanteId;
    }

    public function setTimeVisitanteId(int $timeVisitanteId): void
    {
        $this->timeVisitanteId = $timeVisitanteId;
    }

    public function getNumGolCasa(): int
    {
        return $this->numGolCasa;
    }

    public function setNumGolCasa(int $numGolCasa): void
    {
        $this->numGolCasa = $numGolCasa;
    }

    public function getNumGolVisitante(): int
    {
        return $this->numGolVisitante;
    }

    public function setNumGolVisitante(int $numGolVisitante): void
    {
        $this->numGolVisitante = $numGolVisitante;
    }

    public function getRodada(): int
    {
        return $this->rodada;
    }

    public function setRodada(int $rodada): void
    {
        $this->rodada = $rodada;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }

    public function getTimeCasa(): Equipe
    {
        return $this->timeCasa;
    }

    public function setTimeCasa(Equipe $timeCasa): void
    {
        $this->timeCasa = $timeCasa;
    }

    public function getTimeVisitante(): Equipe
    {
        return $this->timeVisitante;
    }

    public function setTimeVisitante(Equipe $timeVisitante): void
    {
        $this->timeVisitante = $timeVisitante;
    }
}
