<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Campeonato;
use App\Http\Entity\Estatistica;
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

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function add(Campeonato $campeonato, bool $flush = true): void
    {
        $this->entityManager->persist($campeonato);

        if($flush) {
            $this->entityManager->flush($campeonato);
        }
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function update(Campeonato $campeonato, bool $flush = true): void
    {
        if($flush) {
            $this->entityManager->flush($campeonato);
        }
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function delete(Campeonato $campeonato, bool $flush = true): void
    {
        // Não está funcionando
        $this->entityManager->remove($campeonato);

        if ($flush) {
            $this->entityManager->flush();
        }
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