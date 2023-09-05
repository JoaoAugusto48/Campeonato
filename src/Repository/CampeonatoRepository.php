<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Campeonato;
use Doctrine\ORM\EntityManager;

class CampeonatoRepository
{
    private $repository;

    public function __construct(
        // private PDO $pdo,
        // private CampeonatoSql $sql

        private EntityManager $entityManager,

    ) {
        $this->repository = $entityManager->getRepository(Campeonato::class);
    }

    public function add(Campeonato $campeonato): bool
    {
        // $stmt = $this->pdo->prepare($this->sql->insert());
        // $stmt->bindValue(':nome', $campeonato->nome, PDO::PARAM_STR);
        // $stmt->bindValue(':regiao', $campeonato->regiao, PDO::PARAM_STR);
        // $stmt->bindValue(':num_fases', $campeonato->numFases, PDO::PARAM_INT);
        // $stmt->bindValue(':num_equipes', $campeonato->numEquipes, PDO::PARAM_INT);
        // $stmt->bindValue(':rodadas', $campeonato->rodadas, PDO::PARAM_INT);
        // $stmt->bindValue(':num_turnos', $campeonato->numTurnos, PDO::PARAM_INT);
        // $stmt->bindValue(':temporada', $campeonato->temporada, PDO::PARAM_STR);
        // $result = $stmt->execute();
        
        // return $result;
        return false;
    }

    public function update(Campeonato $campeonato): bool
    {
        // $stmt = $this->pdo->prepare($this->sql->update());
        // $stmt->bindValue(':nome', $campeonato->nome, PDO::PARAM_STR);
        // $stmt->bindValue(':regiao', $campeonato->regiao, PDO::PARAM_STR);
        // $stmt->bindValue(':num_fases', $campeonato->numFases, PDO::PARAM_INT);
        // $stmt->bindValue(':num_equipes', $campeonato->numEquipes, PDO::PARAM_INT);
        // $stmt->bindValue(':rodadas', $campeonato->rodadas, PDO::PARAM_INT);
        // $stmt->bindValue(':num_turnos', $campeonato->numTurnos, PDO::PARAM_INT);
        // $stmt->bindValue(':temporada', $campeonato->temporada, PDO::PARAM_STR);
        // $stmt->bindValue(':id', $campeonato->id, PDO::PARAM_INT);
        // $stmt->bindValue(':rodada_atual', $campeonato->rodadaAtual, PDO::PARAM_INT);
        // $stmt->bindValue(':ativado', $campeonato->ativado, PDO::PARAM_BOOL);
        // $result = $stmt->execute();

        // return $result;
        return false;
    }

    public function delete(int $id): bool
    {
        // $stmt = $this->pdo->prepare($this->sql->delete());
        // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // $result = $stmt->execute();
        
        // return $result;
        return false;
    }
    
    public function findById(int $id): Campeonato
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    /** @return \App\Http\Entity\Campeonato[] */
    public function list(): array
    {
        return $this->repository->findAll();
    }    

}