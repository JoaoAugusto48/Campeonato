<?php 

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Campeonato;
use App\Http\Repository\CampeonatoRepository;
use App\Http\Repository\PartidaRepository;
use App\Http\Service\Validation\CampeonatoValidation;

class CampeonatoService
{

    public function __construct(
        private CampeonatoRepository $campeonatoRepository,

        private PartidaRepository $partidaRepository,
    ) {
    }

    /** @return \App\Http\Entity\Campeonato[] */
    public function findAll(): array
    {
        return $this->campeonatoRepository->list();
    }

    public function findById(int $id): Campeonato
    {
        return $this->campeonatoRepository->findById($id);
    }

    public function save(Campeonato $campeonato): bool
    {
        // CampeonatoValidation::validadeCampeonato($campeonato);
        if(isset($campeonato->id)){
            return $this->update($campeonato);
        }

        return $this->insert($campeonato);
    }

    public function insert(Campeonato $campeonato): bool
    {
        return $this->campeonatoRepository->add($campeonato);
    }

    public function update(Campeonato $campeonato): bool
    {
        $camp = $this->findById($campeonato->id);

        if($camp->ativado) {
            if($camp->numTurnos !== $campeonato->numTurnos) {
                throw new \InvalidArgumentException('Número de turnos não pode ser alterado, para campeonatos ativados.');
            }

            if($camp->numEquipes !== $campeonato->numEquipes) {
                throw new \InvalidArgumentException('Número de equipes não pode ser alterado, para campeonatos ativados.');
            }
        }

        $campUpdate = new Campeonato(
            $campeonato->nome,
            $campeonato->regiao,
            $camp->numFases,
            $camp->numEquipes,
            $camp->numTurnos,
            $campeonato->temporada,
            $camp->rodadas,
            ($campeonato->rodadaAtual ?? $camp->rodadaAtual),
            id: $campeonato->id,
            ativado: ($campeonato->ativado ?? $camp->ativado)
        );

        return $this->campeonatoRepository->update($campUpdate);
    }

    public function delete(int $id): bool
    {
        return $this->campeonatoRepository->delete($id);
    }

    public function activateCampeonato(Campeonato $campeonato): bool
    {
        return $this->save($campeonato);
    }

    public function defineProximaRodada(int $campeonatoId, int $rodada)
    {
        $partidasList = $this->partidaRepository->findAllNotPlayedByCampeonatoIdRound($campeonatoId, $rodada);
        $campeonato = $this->findById($campeonatoId);
        
        if((sizeof($partidasList) === 0) && ($campeonato->rodadaAtual !== $campeonato->rodadas) && ($rodada === $campeonato->rodadaAtual)) {

            $newCampeonato = new Campeonato(
                $campeonato->nome,
                $campeonato->regiao,
                $campeonato->numEquipes,
                $campeonato->numEquipes,
                $campeonato->numTurnos,
                $campeonato->temporada,
                $campeonato->rodadas,
                $campeonato->rodadaAtual + 1,
                $campeonato->id,
                $campeonato->ativado
            );
            return $this->save($newCampeonato);
        }

        return false;
    }

}