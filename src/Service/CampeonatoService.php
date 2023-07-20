<?php 

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Campeonato;
use App\Http\Repository\CampeonatoRepository;
use App\Http\Service\Validation\CampeonatoValidation;

class CampeonatoService
{

    public function __construct(
        private CampeonatoRepository $campeonatoRepository
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
        CampeonatoValidation::validadeCampeonato($campeonato);
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
        return $this->campeonatoRepository->update($campeonato);
    }

    public function delete(int $id): bool
    {
        return $this->campeonatoRepository->delete($id);
    }

}