<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Partida;

class PartidaDTO
{
    public readonly ?int $id;
    public readonly int $campeonatoId;
    public readonly int $timeCasaId;
    public readonly int $timeVisitanteId;
    public readonly int $numGolCasa;
    public readonly int $numGolVisitante;
    public readonly int $rodada;
    public readonly ?bool $status;
    public readonly ?EquipeDTO $timeCasa;
    public readonly ?EquipeDTO $timeVisitante;

    public function __construct(Partida $partida) 
    {
        $this->id = $partida->getId();
        $this->campeonatoId = $partida->getCampeonatoId();
        $this->timeCasaId = $partida->getTimeCasaId();
        $this->timeVisitanteId = $partida->getTimeVisitanteId();
        $this->numGolCasa = $partida->getNumGolCasa();
        $this->numGolVisitante = $partida->getNumGolVisitante();
        $this->rodada = $partida->getRodada();
        $this->status = $partida->getStatus();
        
        $this->timeCasa = EquipeDTO::getEquipeDTO($partida->getTimeCasa());
        $this->timeVisitante = EquipeDTO::getEquipeDTO($partida->getTimeVisitante());
    }

    /**
     * @param Partida[] $partidaList
     * @return PartidaDTO[]
     */
    public static function partidaDTOList(array $partidaList): array
    {
        $partidas = [];
        foreach ($partidaList as $partida) {
            $partidas[] = new PartidaDTO($partida);
        }

        return $partidas;
    }

    public static function getPartidaDTO(Partida $partida): PartidaDTO
    {
        return new PartidaDTO($partida);
    }

}