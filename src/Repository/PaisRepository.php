<?php   

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Pais;
use Doctrine\ORM\EntityManager;

class PaisRepository
{
    private $repository;
    
    public function __construct(
        private EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(Pais::class);
    }

    public function add(Pais $pais, $flush=false): bool
    {
        try {
            $pais->status = true;
            $this->entityManager->persist($pais);

            if($flush) {
                $this->entityManager->flush();
            }
            return true;
        } catch (\Throwable) {
            return false;
        }
    }

    public function update(Pais $pais, $flush=false): bool
    {
        try {
            $paisUpdate = $this->findById($pais->id);
            $paisUpdate->nome = $pais->nome;
            $paisUpdate->sigla = $pais->sigla;
            
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
            $paisDelete = $this->findById($id);
            $paisDelete->status = false;

            $flush = false;
            if($flush) {
                $this->entityManager->flush();
            }
            return true;
        } catch (\Throwable) {
            return false;
        }

    }

    public function findById(int $id): Pais
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    /** @return \App\Http\Entity\Pais[] */
    public function listOrderedByNome(): array
    {
        return $this->repository->findBy(
                ['status' => true], 
                ['nome' => 'ASC']
            );
    }
}