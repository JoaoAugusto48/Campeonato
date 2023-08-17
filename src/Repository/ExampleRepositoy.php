<?php

declare(strict_types=1);

namespace App\Http\Repository;
use App\Http\Entity\Equipe;
use App\Http\Entity\Pais;
use PDO;

class ExampleRepository implements Repository
{

    public function __construct(private PDO $pdo) 
    {
    }

    public function add($example): bool
    {
        return false;
    }

    public function update($example): bool
    {
        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function findById(int $id)
    {
        return;
    }

    /** @return \App\Http\Entity\Equipe[] */
    public function list(): array
    {
        return array();
    }

    public function hydrateObjectList(array $dataList): array
    {
        return [];
    }

    public function hydrateObject(array $data): object
    {
        return new Pais('','');
    }
    

}