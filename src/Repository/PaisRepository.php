<?php   

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Pais;
use App\Http\Repository\Sql\PaisSql;
use PDO;

class PaisRepository
{

    public function __construct(
        private PDO $pdo,
        private PaisSql $sql
    ){
    }

    public function add(Pais $pais): bool
    {
        $stmt = $this->pdo->prepare($this->sql->insert());
        $stmt->bindValue(':nome', $pais->nome);
        $stmt->bindValue(':sigla', $pais->sigla);
        $stmt->bindValue(':status', true);
        $result = $stmt->execute();

        return $result;
    }

    public function update(Pais $pais): bool
    {
        $stmt = $this->pdo->prepare($this->sql->update());
        $stmt->bindValue(':nome', $pais->nome);
        $stmt->bindValue(':sigla', $pais->sigla);
        $stmt->bindValue(':id', $pais->id);
        $result = $stmt->execute();

        return $result;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare($this->sql->delete());
        $stmt->bindValue(':status', 0);
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();

        return $result;
    }

    public function findById(int $id): Pais
    {
        $stmt = $this->pdo->prepare($this->sql->findById());
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $this->hydratePais($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Pais[] */
    public function listOrderedByNome(): array
    {
        $stmt = $this->pdo->prepare($this->sql->findAll());
        $stmt->execute();

        return $this->hydratePaisList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    
    /**  @return \App\Http\Entity\Pais[] */
    private function hydratePaisList(array $paisDataList): array
    {
        $paisList = [];

        foreach($paisDataList as $paisData) {
            $paisList[] = Pais::fromArray($paisData);
        }

        return $paisList;
    }

    private function hydratePais(array $paisData): Pais
    {
        return Pais::fromArray($paisData);
    }

}