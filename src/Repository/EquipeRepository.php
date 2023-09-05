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

    public function add(Equipe $equipe, $flush=false): bool
    {
        try {
            $this->entityManager->persist($equipe);
            
            if($flush) {
                $this->entityManager->flush();
            }

            return true;
        } catch (\Throwable) {
            return false;
        }
    }

    public function update(Equipe $equipe, $flush=false): bool
    {
        try {
            $equipeUpdate = $this->findById($equipe->id);
            $equipeUpdate->nome = $equipe->nome;
            $equipeUpdate->sigla = $equipe->sigla;

            if($flush) {
                $this->entityManager->flush();
            }

            return true;
        } catch (\Throwable) {
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $equipeDelete = $this->findById($id);
            $this->entityManager->remove($equipeDelete);

            $flush = false;
            if ($flush) {
                $this->entityManager->flush();
            }

            return true;
        } catch (\Throwable) {
            return false;
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