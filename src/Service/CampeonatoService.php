<?php 

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Campeonato;
use App\Http\Repository\CampeonatoRepository;

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
        return new Campeonato('',0,0);
    }

    public function insert(Campeonato $campeonato): bool
    {
        return false;
    }

    public function update(Campeonato $campeonato): bool
    {
        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

}