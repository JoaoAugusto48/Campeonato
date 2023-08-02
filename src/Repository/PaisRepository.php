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
        $stmt->bindValue(':nome', $pais->nome, PDO::PARAM_STR);
        $stmt->bindValue(':sigla', $pais->sigla, PDO::PARAM_STR);
        $stmt->bindValue(':status', true, PDO::PARAM_BOOL);
        $result = $stmt->execute();

        return $result;
    }

    public function update(Pais $pais): bool
    {
        $stmt = $this->pdo->prepare($this->sql->update());
        $stmt->bindValue(':nome', $pais->nome, PDO::PARAM_STR);
        $stmt->bindValue(':sigla', $pais->sigla, PDO::PARAM_STR);
        $stmt->bindValue(':id', $pais->id, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare($this->sql->delete());
        $stmt->bindValue(':status', false, PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    public function findById(int $id): Pais
    {
        $stmt = $this->pdo->prepare($this->sql->findById());
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
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