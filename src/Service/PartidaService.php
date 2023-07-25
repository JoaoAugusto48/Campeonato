<?php 

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Partida;
use App\Http\Repository\PartidaRepository;

class PartidaService
{

    public function __construct(
        private PartidaRepository $partidaRepository
    ) {

    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAll(): array
    {
        return array();
    }

    public function findById(int $id): Partida
    {
        return new Partida(0, 0, 0, 0, 0, 0);
    }

    public function save(Partida $partida): bool
    {
        if(isset($partida->id)){
            return $this->update($partida);
        }

        return $this->save($partida);
    }

    private function insert(Partida $partida): bool
    {
        return false;
    }

    private function update(Partida $partida): bool
    {
        return false;
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

}