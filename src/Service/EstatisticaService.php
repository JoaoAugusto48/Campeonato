<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Equipe;
use App\Http\Entity\Estatistica;
use App\Http\Entity\Partida;
use App\Http\Repository\EstatisticaRepository;

class EstatisticaService
{
    public function __construct(
        private EstatisticaRepository $estatisticaRepository,
    ) {
    }

    public function save(Estatistica $estatistica): bool
    {
        if(isset($estatistica->id)){
            return $this->update($estatistica);
        }

        return $this->save($estatistica);
    }

    private function insert(Estatistica $estatistica): bool
    {
        return false;
    }

    private function update(Estatistica $estatistica): bool
    {
        return false;
    }

    public function defineEstatistica(Partida $partidaResult, Estatistica $estatCasa, Estatistica $estatVisitante)
    {
        $newVitoriaCasa = 0;
        $newDerrotaCasa = 0;
        $newEmpateCasa = 0;

        if($partidaResult->numGolCasa > $partidaResult->numGolVisitante) {
            $newVitoriaCasa++;
        } else if($partidaResult->numGolVisitante > $partidaResult->numGolCasa) {
            $newDerrotaCasa++;
        } else {
            $newEmpateCasa++;
        }

        $novaEstatCasa = new Estatistica(
            $estatCasa->vitorias + $newVitoriaCasa,
            $estatCasa->empates + $newEmpateCasa,
            $estatCasa->derrotas + $newDerrotaCasa,
            $estatCasa->golsPro + $partidaResult->numGolCasa,
            $estatCasa->golsContra + $partidaResult->numGolVisitante,
            $partidaResult->campeonatoId,
            $estatCasa->equipeId,
            $estatCasa->id
        );

        $novaEstatVisitante = new Estatistica(
            $estatVisitante->vitorias + $newDerrotaCasa,
            $estatVisitante->empates + $newEmpateCasa,
            $estatVisitante->derrotas + $newVitoriaCasa,
            $estatVisitante->golsPro + $partidaResult->numGolVisitante,
            $estatVisitante->golsContra + $partidaResult->numGolCasa,
            $partidaResult->campeonatoId,
            $estatVisitante->equipeId,
            $estatVisitante->id
        );

        var_dump($partidaResult);
        var_dump($novaEstatCasa);
        var_dump($novaEstatVisitante);
        exit;

    }

    /** @return \App\Http\Entity\Estatistica[]  */
    public function findByCampeonatoId(int $champId): array
    {
        return $this->estatisticaRepository->findAllByCampeonatoId($champId);
    }

    /** @return \App\Http\Entity\Estatistica[]  */
    public function findByCampeonatoEquipeId(int $champId, int $equipe1Id, int $equipe2Id): array
    {
        return $this->estatisticaRepository->findByCampeonatoEquipesId($champId, $equipe1Id, $equipe2Id);
    }

}