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

    public function save(Campeonato $campeonato, bool $flush = true): void
    {
        // CampeonatoValidation::validadeCampeonato($campeonato);
        if(!is_null($campeonato->getId())){
            $this->update($campeonato, $flush);
        }

        $this->insert($campeonato, $flush);
    }

    private function insert(Campeonato $campeonato, bool $flush): void
    {
        $campeonato->setAtivado(false);
        $this->campeonatoRepository->add($campeonato, $flush);
    }

    private function update(Campeonato $campeonato, bool $flush): void
    {
        if($campeonato->getAtivado()) {
            
            $camp = $this->findById($campeonato->getId());

            if($camp->getNumTurnos() !== $campeonato->getNumTurnos()) {
                throw new \InvalidArgumentException('Número de turnos não pode ser alterado, para campeonatos ativados.');
            }

            if($camp->getNumEquipes() !== $campeonato->getNumEquipes()) {
                throw new \InvalidArgumentException('Número de equipes não pode ser alterado, para campeonatos ativados.');
            }
        }

        $this->campeonatoRepository->update($campeonato, $flush);
    }

    public function delete(int $id, bool $flush = true): void
    {
        $campeonato = $this->findById($id);
        $this->campeonatoRepository->delete($campeonato, $flush);
    }

    public function activateCampeonato(Campeonato $campeonato): void
    {
        $this->save($campeonato);
    }

    public function defineProximaRodada(int $campeonatoId, int $rodada)
    {
        $partidasList = $this->partidaRepository->findAllNotPlayedByCampeonatoIdRound($campeonatoId, $rodada);
        $campeonato = $this->findById($campeonatoId);
        
        if((sizeof($partidasList) === 0) && ($campeonato->getRodadaAtual() !== $campeonato->getRodadas()) && ($rodada === $campeonato->getRodadaAtual())) {

            $campeonato->setRodadaAtual($campeonato->getRodadaAtual() + 1);

            $newCampeonato = new Campeonato(
                $campeonato->getNome(),
                $campeonato->getRegiao(),
                $campeonato->getNumFases(),
                $campeonato->getNumEquipes(),
                $campeonato->getNumTurnos(),
                $campeonato->getTemporada(),
                $campeonato->getRodadas(),
                $campeonato->getRodadaAtual(),
                $campeonato->getId(),
                $campeonato->getAtivado()
            );
            return $this->save($newCampeonato);
        }

        return false;
    }

}