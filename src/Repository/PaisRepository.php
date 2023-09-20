<?php   

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Pais;
use Doctrine\ORM\EntityManager;

class PaisRepository
{
    private $repository;
    
    public function __construct(
        private EntityManager $entityManager,
    ) {
        $this->repository = $entityManager->getRepository(Pais::class);
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function add(Pais $pais, $flush = true): void
    {
        $pais->setStatus(true);
        $this->entityManager->persist($pais);

        if($flush) {
            $this->entityManager->flush();
        }
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function update(Pais $pais, bool $flush = true): void
    {
        // var_dump($this->entityManager->getUnitOfWork()->getIdentityMap());
        // exit;
        if($flush) {
            $this->entityManager->flush($pais);
        }      
    }

    /** 
     * @throws \Doctrine\ORM\OptimisticLockException 
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    public function delete(int $id, bool $flush = true): void
    {
        $paisDelete = $this->findById($id);
        $paisDelete->setStatus(false);

        if($flush) {
            $this->entityManager->flush();
        }
    }

    public function findById(int $id): Pais
    {
        return $this->repository->findOneBy(['id' => $id]);
    }

    /** 
     * @return \App\Http\Entity\Pais[] 
     */
    public function listOrderedByNome(): array
    {
        return $this->repository->findBy(
                ['status' => true], 
                ['nome' => 'ASC']
            );
    }
}