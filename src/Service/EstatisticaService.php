<?php

declare(strict_types=1);

namespace App\Http\Service;

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
        // EstatisticaValidation::validaEstatistica($estatistica);
        if(!is_null($estatistica->getId())){
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

        if($partidaResult->getNumGolCasa() > $partidaResult->getNumGolVisitante()) {
            $newVitoriaCasa++;
        } else if($partidaResult->getNumGolVisitante() > $partidaResult->getNumGolCasa()) {
            $newDerrotaCasa++;
        } else {
            $newEmpateCasa++;
        }

        if($oldPartida->getStatus()){
            // Verifica resultado atual com o anterior da equipe
            if($oldPartida->getNumGolCasa() > $oldPartida->getNumGolVisitante()) {
                $newVitoriaCasa--;
            } else if($oldPartida->getNumGolVisitante() > $oldPartida->getNumGolCasa()) {
                $newDerrotaCasa--;
            } else {
                $newEmpateCasa--;
            }
        }

        // Define gols feitos e sofridos
        $newGolsCasa = $partidaResult->getNumGolCasa() - $oldPartida->getNumGolCasa();
        $newGolsVisitante = $partidaResult->getNumGolVisitante() - $oldPartida->getNumGolVisitante();

        $novaEstatCasa = new Estatistica(
            $estatCasa->getVitorias() + $newVitoriaCasa,
            $estatCasa->getEmpates() + $newEmpateCasa,
            $estatCasa->getDerrotas() + $newDerrotaCasa,
            $estatCasa->getGolsPro() + $newGolsCasa,
            $estatCasa->getGolsContra() + $newGolsVisitante,
            $partidaResult->getCampeonatoId(),
            $estatCasa->getEquipeId(),
            $estatCasa->getId()
        );

        $novaEstatVisitante = new Estatistica(
            $estatVisitante->getVitorias() + $newDerrotaCasa,
            $estatVisitante->getEmpates() + $newEmpateCasa,
            $estatVisitante->getDerrotas() + $newVitoriaCasa,
            $estatVisitante->getGolsPro() + $newGolsVisitante,
            $estatVisitante->getGolsContra() + $newGolsCasa,
            $partidaResult->getCampeonatoId(),
            $estatVisitante->getEquipeId(),
            $estatVisitante->getId()
        );
        
        $estatList = [$novaEstatCasa, $novaEstatVisitante];
        $result = $this->estatisticaRepository->updateTwo($estatList);
        return $result;
    }

    /** @return \App\Http\Entity\Estatistica[]  */
    public function findByCampeonatoId(int $champId): array
    {
        $classificacao = $this->estatisticaRepository->findAllByCampeonatoId($champId);
        usort($classificacao, function(Estatistica $equipeA, Estatistica $equipeB) {
            
            if($equipeA->getPontos() != $equipeB->getPontos()) {
                // por pontos
                return ($equipeA->getPontos() < $equipeB->getPontos()) ? 1 : -1;
            }  
            if($equipeA->getSaldoGols() != $equipeB->getSaldoGols()){
                // por saldo de gols
                return ($equipeA->getSaldoGols() < $equipeB->getSaldoGols()) ? 1 : -1;
            } 
            
            if($equipeA->getGolsPro() != $equipeB->getGolsPro()) {
                // por Gols a favor
                return ($equipeA->getGolsPro() < $equipeB->getGolsPro()) ? 1 : -1;
            } 
            if($equipeA->getVitorias() != $equipeB->getVitorias()) {
                // por vitórias
                return ($equipeA->getVitorias() < $equipeB->getVitorias()) ? 1 : -1;
            }
    
            // Mantém
            return 0;
        });

        return $classificacao;
    }

    /** @return \App\Http\Entity\Estatistica[]  */
    public function findByCampeonatoEquipeId(int $champId, int $equipe1Id, int $equipe2Id, int $rodada): array
    {
        return $this->estatisticaRepository->findByCampeonatoEquipesId($champId, $equipe1Id, $equipe2Id, $rodada);
    }
}