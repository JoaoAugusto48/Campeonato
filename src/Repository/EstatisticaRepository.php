<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Estatistica;
use Doctrine\ORM\EntityManager;

class EstatisticaRepository
{
    private $repository;

    public function __construct(
        private EntityManager $entityManager
    ){
        $this->repository = $entityManager->getRepository(Estatistica::class);
    }

    /** @param \App\Http\Entity\Estatistica[] $estatisticaList */
    public function updateTwo(array $estatisticaList): bool
    {
        // if(sizeof($estatisticaList) !== 2) {
        //     return false;
        // }
        // $stmt = $this->pdo->prepare($this->sql->updateTwo());
        // $stmt->bindValue(':vitorias', $estatisticaList[0]->vitorias, PDO::PARAM_INT);
        // $stmt->bindValue(':empates', $estatisticaList[0]->empates, PDO::PARAM_INT);
        // $stmt->bindValue(':derrotas', $estatisticaList[0]->derrotas, PDO::PARAM_INT);
        // $stmt->bindValue(':gols_pro', $estatisticaList[0]->golsPro, PDO::PARAM_INT);
        // $stmt->bindValue(':gols_contra', $estatisticaList[0]->golsContra, PDO::PARAM_INT);
        // $stmt->bindValue(':id', $estatisticaList[0]->id, PDO::PARAM_INT);
        
        // $stmt->bindValue(':vitorias2', $estatisticaList[1]->vitorias, PDO::PARAM_INT);
        // $stmt->bindValue(':empates2', $estatisticaList[1]->empates, PDO::PARAM_INT);
        // $stmt->bindValue(':derrotas2', $estatisticaList[1]->derrotas, PDO::PARAM_INT);
        // $stmt->bindValue(':gols_pro2', $estatisticaList[1]->golsPro, PDO::PARAM_INT);
        // $stmt->bindValue(':gols_contra2', $estatisticaList[1]->golsContra, PDO::PARAM_INT);
        // $stmt->bindValue(':id2', $estatisticaList[1]->id, PDO::PARAM_INT);
        
        // $result = $stmt->execute();

        // return $result;
        return false;
    }

    /** @return \App\Http\Entity\Estatistica[] */
    public function findAllByCampeonatoId(int $campId): array
    {
        /** @var Estatistica[] $estatisticaList */
        $estatisticaList = $this->repository->findBy([
                'campeonatoId' => $campId
            ]);
        
        // rolando um problema louco quando realizo um var_dump()
        foreach($estatisticaList as $estatistica) {
            $estatistica->calcularDetalhes();
        }

        return $estatisticaList;
    }

    /** @return \App\Http\Entity\Estatistica[] */
    public function findByCampeonatoEquipesId(int $campId, int $equipe1Id, int $equipe2Id): array
    {
        return $this->repository->findBy([
            'campeonatoId' => $campId,
            'equipeId' => [$equipe1Id, $equipe2Id],
        ]);
    }

}