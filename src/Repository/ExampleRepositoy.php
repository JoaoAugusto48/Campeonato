<?php

declare(strict_types=1);

use PDO;

class ExampleRepository
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
    

}