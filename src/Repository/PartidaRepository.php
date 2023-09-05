<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Partida;
use Doctrine\ORM\EntityManager;

class PartidaRepository
{
    private $repository;

    public function __construct(
        private EntityManager $entityManager,
    ) {
        $this->repository = $entityManager->getRepository(Partida::class);
    }

    public function add(Partida $partida): bool
    {
        return false;
    }

    public function update(Partida $partida): bool
    {
        // $stmt = $this->pdo->prepare($this->sql->update());
        // $stmt->bindValue(':campeonatos_id', $partida->campeonatoId, PDO::PARAM_INT);
        // $stmt->bindValue(':time_casa', $partida->timeCasaId, PDO::PARAM_INT);
        // $stmt->bindValue(':time_visitante', $partida->timeVisitanteId, PDO::PARAM_INT);
        // $stmt->bindValue(':num_gols_casa', $partida->numGolCasa, PDO::PARAM_INT);
        // $stmt->bindValue(':num_gols_visitante', $partida->numGolVisitante, PDO::PARAM_INT);
        // $stmt->bindValue(':rodada', $partida->rodada, PDO::PARAM_INT);
        // $stmt->bindValue(':status', $partida->status, PDO::PARAM_BOOL);
        // $stmt->bindValue(':id', $partida->id, PDO::PARAM_INT);
        // $result = $stmt->execute();
        
        // return $result;

        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function findById(int $id)
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAllByCampeonatoId(int $campId): array
    {
        try {
            return $this->repository->findBy(['campeonatoId' => $campId]);
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAllNotPlayedByCampeonatoIdRound(int $campId, int $round): array
    {
        return $this->repository->findBy([
            'campeonatoId' => $campId,
            'rodada' => $round,
            'status' => false
        ]);
    }

    /** @return \App\Http\Entity\Partida[] */
    public function list(): array
    {
        return [];
    }    
}