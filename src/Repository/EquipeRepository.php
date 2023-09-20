<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Equipe;
use Doctrine\ORM\EntityManager;

class EquipeRepository
{
    private $repository;

    public function __construct(
        private EntityManager $entityManager,
    ) {
        $this->repository = $entityManager->getRepository(Equipe::class);
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function add(Equipe $equipe, $flush = true): void
    {
        $this->entityManager->persist($equipe);
        
        if($flush) {
            $this->entityManager->flush();
        }
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function update(Equipe $equipe, $flush = true): void
    {
        if($flush) {
            $this->entityManager->flush($equipe);
        }
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function delete(Equipe $equipe, bool $flush = true): void
    {
        // não está funcionando
        $this->entityManager->remove($equipe);

        if ($flush) {
            $this->entityManager->flush();
        }
    }

    public function findById(int $id): Equipe
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    /** @return \App\Http\Entity\Equipe[] */
    public function list(): array
    {
        return $this->repository->findBy([], ['nome' => 'ASC']);
    }
    

}