<?php 

declare(strict_types=1);

namespace App\Http\Repository;

interface Repository
{
    public function hydrateObjectList(array $dataList): array;
    public function hydrateObject(array $data): object;

}