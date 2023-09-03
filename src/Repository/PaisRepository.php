<?php   

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Pais;
use App\Http\Helper\EntityManagerCreator;

class PaisRepository implements Repository
{
    private $paisRepository;
    private $entityManager;

    public function __construct(
        // private PDO $pdo,
        // private PaisSql $sql
    ){
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->paisRepository = $this->entityManager->getRepository(Pais::class);
    }

    public function add(Pais $pais): bool
    {
        // $stmt = $this->pdo->prepare($this->sql->insert());
        // $stmt->bindValue(':nome', $pais->nome, PDO::PARAM_STR);
        // $stmt->bindValue(':sigla', $pais->sigla, PDO::PARAM_STR);
        // $stmt->bindValue(':status', true, PDO::PARAM_BOOL);
        // $result = $stmt->execute();

        // return $result;
        try {
            $pais->status = true;

            $this->entityManager->persist($pais);
            $this->entityManager->flush();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update(Pais $pais): bool
    {
        // $stmt = $this->pdo->prepare($this->sql->update());
        // $stmt->bindValue(':nome', $pais->nome, PDO::PARAM_STR);
        // $stmt->bindValue(':sigla', $pais->sigla, PDO::PARAM_STR);
        // $stmt->bindValue(':id', $pais->id, PDO::PARAM_INT);
        // $result = $stmt->execute();

        // return $result;
        try {
            $paisUpdate = $this->findById($pais->id);
            $paisUpdate->nome = $pais->nome;
            $paisUpdate->sigla = $pais->sigla;
            
            $this->entityManager->flush();
            
            return true;
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        // $stmt = $this->pdo->prepare($this->sql->delete());
        // $stmt->bindValue(':status', false, PDO::PARAM_BOOL);
        // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // $result = $stmt->execute();

        // return $result;
        try {
            $paisDelete = $this->findById($id);
            $paisDelete->status = false;
            $this->entityManager->flush();

            return true;
        } catch (\Throwable) {
            return false;
        }

    }

    public function findById(int $id): Pais
    {
        // $stmt = $this->pdo->prepare($this->sql->findById());
        // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // $stmt->execute();

        // return $this->hydrateObject($stmt->fetch(PDO::FETCH_ASSOC));
        return $this->paisRepository->findOneBy(['id' => $id]);
    }

    /** @return \App\Http\Entity\Pais[] */
    public function listOrderedByNome(): array
    {
        // $stmt = $this->pdo->prepare($this->sql->findAll());
        // $stmt->execute();

        // return $this->hydrateObjectList($stmt->fetchAll(PDO::FETCH_ASSOC));
        
        return $this->paisRepository->findBy(
                ['status' => true], 
                ['nome' => 'ASC']
            );
    }

    
    /**  @return \App\Http\Entity\Pais[] */
    public function hydrateObjectList(array $paisDataList): array
    {
        $paisList = [];

        foreach($paisDataList as $paisData) {
            $paisList[] = Pais::fromArray($paisData);
        }

        return $paisList;
    }

    public function hydrateObject(array $paisData): Pais
    {
        return Pais::fromArray($paisData);
    }

}