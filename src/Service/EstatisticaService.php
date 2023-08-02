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

    public function defineEstatistica(Partida $partidaResult, Estatistica $estatCasa, Estatistica $estatVisitante, Partida $oldPartida = new Partida(0,0,0,0,0,0,0,false)): bool
    {
        $newVitoriaCasa = 0;
        $newDerrotaCasa = 0;
        $newEmpateCasa = 0;
        $newGolsCasa = 0;
        $newGolsVisitante = 0;

        if($partidaResult->numGolCasa > $partidaResult->numGolVisitante) {
            $newVitoriaCasa++;
        } else if($partidaResult->numGolVisitante > $partidaResult->numGolCasa) {
            $newDerrotaCasa++;
        } else {
            $newEmpateCasa++;
        }

        if($oldPartida->status){
            // Verifica resultado atual com o anterior da equipe
            if($oldPartida->numGolCasa > $oldPartida->numGolVisitante) {
                $newVitoriaCasa--;
            } else if($oldPartida->numGolVisitante > $oldPartida->numGolCasa) {
                $newDerrotaCasa--;
            } else {
                $newEmpateCasa--;
            }
        }

        // Define gols feitos e sofridos
        $newGolsCasa = $partidaResult->numGolCasa - $oldPartida->numGolCasa;
        $newGolsVisitante = $partidaResult->numGolVisitante - $oldPartida->numGolVisitante;

        $novaEstatCasa = new Estatistica(
            $estatCasa->vitorias + $newVitoriaCasa,
            $estatCasa->empates + $newEmpateCasa,
            $estatCasa->derrotas + $newDerrotaCasa,
            $estatCasa->golsPro + $newGolsCasa,
            $estatCasa->golsContra + $newGolsVisitante,
            $partidaResult->campeonatoId,
            $estatCasa->equipeId,
            $estatCasa->id
        );

        $novaEstatVisitante = new Estatistica(
            $estatVisitante->vitorias + $newDerrotaCasa,
            $estatVisitante->empates + $newEmpateCasa,
            $estatVisitante->derrotas + $newVitoriaCasa,
            $estatVisitante->golsPro + $newGolsVisitante,
            $estatVisitante->golsContra + $newGolsCasa,
            $partidaResult->campeonatoId,
            $estatVisitante->equipeId,
            $estatVisitante->id
        );
        
        $estatList = [$novaEstatCasa, $novaEstatVisitante];
        $result = $this->estatisticaRepository->updateTwo($estatList);
        return $result;
    }

    /** @return \App\Http\Entity\Estatistica[]  */
    public function findByCampeonatoId(int $champId): array
    {
        $classificacao = $this->estatisticaRepository->findAllByCampeonatoId($champId);
        usort($classificacao, function($equipeA, $equipeB) {
            
            if($equipeA->pontos != $equipeB->pontos) {
                return ($equipeA->pontos < $equipeB->pontos) ? 1 : -1;
            }  
            if($equipeA->saldoGols != $equipeB->saldoGols){
                return ($equipeA->saldoGols < $equipeB->saldoGols) ? 1 : -1;
            } 
            
            if($equipeA->golsPro != $equipeB->golsPro) {
                return ($equipeA->golsPro < $equipeB->saldoGols) ? 1 : -1;
            } 
            if($equipeA->vitorias != $equipeB->vitorias) {
                return ($equipeA->vitorias < $equipeB->vitorias) ? 1 : -1;
            }
    
            return 0;
        });

        return $classificacao;
    }

    /** @return \App\Http\Entity\Estatistica[]  */
    public function findByCampeonatoEquipeId(int $champId, int $equipe1Id, int $equipe2Id): array
    {
        return $this->estatisticaRepository->findByCampeonatoEquipesId($champId, $equipe1Id, $equipe2Id);
    }
}