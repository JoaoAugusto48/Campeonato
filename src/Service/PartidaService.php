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

    public function save(Partida $partida, bool $flush = true): bool
    {
        if(!is_null($partida->getId())){
            return $this->update($partida, $flush);
        }

        return $this->insert($partida, $flush);
    }

    private function insert(Partida $partida, bool $flush): bool
    {
        return false;
    }

    private function update(Partida $partida, bool $flush): bool
    {
        $equipesEstatistica = $this->estatisticaService->findByCampeonatoEquipeId($partida->getCampeonatoId(), $partida->getTimeCasaId(), $partida->getTimeVisitanteId(), $partida->getRodada());
        var_dump($equipesEstatistica);
        exit;
        $oldPartida = $this->partidaRepository->findById($partida->getId());

        $estatEquipeCasa = $equipesEstatistica[0];
        $estatEquipeVisitante = $equipesEstatistica[1];
        if($equipesEstatistica[1]->getEquipeId() === $partida->getTimeCasaId()) {
            $estatEquipeCasa = $equipesEstatistica[1];
            $estatEquipeVisitante = $equipesEstatistica[0];
        }

        $partidaResult = new Partida(
            $partida->getCampeonatoId(),
            $estatEquipeCasa->getEquipeId(),
            $estatEquipeVisitante->getEquipeId(),
            $partida->getRodada(),
            $partida->getNumGolCasa(),
            $partida->getNumGolVisitante(),
            $partida->getId()
        );

        $estatResult = false;
        // melhorar
        if($oldPartida->status) {
            $estatResult = $this->estatisticaService->defineEstatistica($partidaResult, $estatEquipeCasa, $estatEquipeVisitante, $oldPartida);
        } else {
            $estatResult = $this->estatisticaService->defineEstatistica($partidaResult, $estatEquipeCasa, $estatEquipeVisitante);
        }

        $partidaResult = $estatResult ? $this->partidaRepository->update($partida) : false;
        $this->campeonatoService->defineProximaRodada($partida->getCampeonatoId(), $partida->getRodada());

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