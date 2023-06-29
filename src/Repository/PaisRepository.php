<?php   

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Pais;
use PDO;

class PaisRepository
{

    public function __construct(private PDO $pdo)
    {
    }

    public function add(Pais $pais): bool
    {
        $sql = 'INSERT INTO pais (nome, sigla, status) VALUE (:nome, :sigla, :status)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $pais->nome);
        $stmt->bindValue(':sigla', $pais->sigla);
        $stmt->bindValue(':status', true);
        $result = $stmt->execute();

        return $result;
    }

    public function update(Pais $pais): bool
    {
        $sql = 'UPDATE pais SET nome=:nome, sigla=:sigla WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $pais->nome);
        $stmt->bindValue(':sigla', $pais->sigla);
        $stmt->bindValue(':id', $pais->id);
        $result = $stmt->execute();

        return $result;
    }

    public function delete(int $id): bool
    {
        $sql = 'UPDATE pais SET status=:status WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':status', 0);
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();

        return $result;
    }

    public function findById(int $id): Pais
    {
        $sql = 'SELECT * FROM pais WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $this->hydratePais($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Pais[] */
    public function listOrderedByNome(): array
    {
        $sql = 'SELECT * FROM pais WHERE status=1 ORDER BY nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $this->hydratePaisList($stmt);
    }

    
    /**  @return Pais[] */
    private function hydratePaisList(\PDOStatement $stmt): array
    {
        $paisDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $paisList = [];

        foreach($paisDataList as $paisData) {
            $pais = new Pais($paisData['nome'], $paisData['sigla']);
            $pais->setId($paisData['id']);
            $paisList[] = $pais;
        }

        return $paisList;
    }

    private function hydratePais(array $paisData): Pais
    {
        $pais = new Pais($paisData['nome'], $paisData['sigla']);
        $pais->setId($paisData['id']);

        return $pais;
    }

}