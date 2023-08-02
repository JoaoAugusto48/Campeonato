<?php 

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Partida;
use App\Http\Repository\PartidaRepository;
use DI\ContainerBuilder;

class PartidaService
{

    public function __construct(
        private PartidaRepository $partidaRepository,
        private EstatisticaService $estatisticaService,
        private CampeonatoService $campeonatoService,
    ) {
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAll(): array
    {
        return array();
    }

    public function findById(int $id): Partida
    {
        return $this->partidaRepository->findById($id);
    }

    public function save(Partida $partida): bool
    {
        if(isset($partida->id)){
            return $this->update($partida);
        }

        return $this->insert($partida);
    }

    private function insert(Partida $partida): bool
    {
        return false;
    }

    private function update(Partida $partida): bool
    {
        $equipesEstatistica = $this->estatisticaService->findByCampeonatoEquipeId($partida->campeonatoId, $partida->timeCasaId, $partida->timeVisitanteId);
        $oldPartida = $this->partidaRepository->findById($partida->id);

        $estatEquipeCasa = $equipesEstatistica[0];
        $estatEquipeVisitante = $equipesEstatistica[1];
        if($equipesEstatistica[1]->equipeId === $partida->timeCasaId) {
            $estatEquipeCasa = $equipesEstatistica[1];
            $estatEquipeVisitante = $equipesEstatistica[0];
        }

        $partidaResult = new Partida(
            $partida->campeonatoId,
            $estatEquipeCasa->equipeId,
            $estatEquipeVisitante->equipeId,
            $partida->rodada,
            $partida->numGolCasa,
            $partida->numGolVisitante,
            $partida->id
        );

        $estatResult = false;
        // melhorar
        if($oldPartida->status) {
            $estatResult = $this->estatisticaService->defineEstatistica($partidaResult, $estatEquipeCasa, $estatEquipeVisitante, $oldPartida);
        } else {
            $estatResult = $this->estatisticaService->defineEstatistica($partidaResult, $estatEquipeCasa, $estatEquipeVisitante);
        }

        $partidaResult = $estatResult ? $this->partidaRepository->update($partida) : false;
        $this->campeonatoService->defineProximaRodada($partida->campeonatoId, $partida->rodada);

        return $estatResult && $partidaResult;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAllByCampeonatoId(int $campId): array
    {
        return $this->partidaRepository->findAllByCampeonatoId($campId);
    }

    /** 
     * @return \App\Http\Entity\Partida[] 
     * */
    public function findAllNotPlayedByCampeonatoIdRound(int $campId, int $round): array
    {
        return $this->partidaRepository->findAllNotPlayedByCampeonatoIdRound($campId, $round);
    } 

}