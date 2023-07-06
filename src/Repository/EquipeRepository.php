<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Equipe;
use App\Http\Entity\Pais;
use App\Http\Service\PaisService;
use PDO;

class EquipeRepository
{

    public function __construct(
        private PDO $pdo,
        private PaisService $paisService
    ) {
    }

    public function add(Equipe $equipe): bool
    {
        $sql = 'INSERT INTO equipes (nome, sigla, pais_id) VALUE (:nome, :sigla, :pais_id);';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $equipe->nome);
        $stmt->bindValue(':sigla', $equipe->sigla);
        $stmt->bindValue(':pais_id', $equipe->pais->id);
        $result = $stmt->execute();
        
        return $result;
    }

    public function update(Equipe $equipe): bool
    {
        $sql = 'UPDATE equipes SET nome=:nome, sigla=:sigla, pais_id=:pais_id WHERE id=:id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $equipe->nome);
        $stmt->bindValue(':sigla', $equipe->sigla);
        $stmt->bindValue(':pais_id', $equipe->pais->id);
        $stmt->bindValue(':id', $equipe->id);
        $result = $stmt->execute();

        return $result;
    }

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM equipes WHERE id=:id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();

        return $result;
    }

    public function findById(int $id): Equipe
    {
        $sql = 'SELECT id, nome, sigla, pais_id FROM equipes WHERE id=:id;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $this->hydrateEquipe($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Equipe[] */
    public function list(): array
    {
        $sql = 'SELECT e.id, e.nome, e.sigla, e.pais_id, p.id as pais_id, p.nome as pais_nome, p.sigla as pais_sigla FROM equipes as e JOIN pais as p where e.pais_id = p.id ORDER BY e.nome;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $this->hydrateEquipeList($stmt);
    }

    /** @return \App\Http\Entity\Equipe[] */
    private function hydrateEquipeList(\PDOStatement $stmt): array
    {
        $equipeDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $equipeList = [];

        foreach ($equipeDataList as $equipeData) {
            $pais = new Pais(
                $equipeData['pais_nome'],
                $equipeData['pais_sigla']
            );
            $pais->setId($equipeData['pais_id']);

            $equipe = new Equipe(
                $equipeData['nome'],
                $equipeData['sigla'],
                $pais
            );
            $equipe->setId($equipeData['id']);

            $equipeList[] = $equipe; 
        }

        return $equipeList;
    }

    private function hydrateEquipe(array $equipeData): Equipe
    {
        $pais = $this->paisService->findById($equipeData['pais_id']);

        $equipe = new Equipe($equipeData['nome'], $equipeData['sigla'], $pais);
        $equipe->setId($equipeData['id']);

        return $equipe;
    }
    

}