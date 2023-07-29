<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Equipe;
use App\Http\Entity\Pais;
use App\Http\Repository\Sql\EquipeSql;
use App\Http\Service\PaisService;
use PDO;

class EquipeRepository
{

    public function __construct(
        private PDO $pdo,
        private EquipeSql $sql,

        private PaisService $paisService
    ) {
    }

    public function add(Equipe $equipe): bool
    {
        $stmt = $this->pdo->prepare($this->sql->insert());
        $stmt->bindValue(':nome', $equipe->nome);
        $stmt->bindValue(':sigla', $equipe->sigla);
        $stmt->bindValue(':pais_id', $equipe->paisId);
        $result = $stmt->execute();
        
        return $result;
    }

    public function update(Equipe $equipe): bool
    {
        $stmt = $this->pdo->prepare($this->sql->update());
        $stmt->bindValue(':nome', $equipe->nome);
        $stmt->bindValue(':sigla', $equipe->sigla);
        $stmt->bindValue(':pais_id', $equipe->paisId);
        $stmt->bindValue(':id', $equipe->id);
        $result = $stmt->execute();

        return $result;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare($this->sql->delete());
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();

        return $result;
    }

    public function findById(int $id): Equipe
    {
        $stmt = $this->pdo->prepare($this->sql->findById());
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $this->hydrateEquipe($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Equipe[] */
    public function list(): array
    {
        $stmt = $this->pdo->prepare($this->sql->findAllWithPais());
        $stmt->execute();

        return $this->hydrateEquipeList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Equipe[] */
    private function hydrateEquipeList(array $equipeDataList): array
    {
        $equipeList = [];

        foreach ($equipeDataList as $equipeData) {
            $pais = Pais::fromArray($equipeData, 'pais_nome', 'pais_sigla', 'pais_id'); 
            $equipeData['pais'] = $pais;

            $equipeList[] = Equipe::fromArray($equipeData); 
        }

        return $equipeList;
    }

    private function hydrateEquipe(array $equipeData): Equipe
    {
        $equipeData['pais'] = $this->paisService->findById($equipeData['pais_id']);

        return Equipe::fromArray($equipeData);
    }
    

}