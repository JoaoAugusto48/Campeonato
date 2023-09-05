<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Pais;
use App\Http\Repository\PaisRepository;
use App\Http\Service\Validation\PaisValidation;

class PaisService
{

    public function __construct(
        private PaisRepository $paisRepository
    ) {
    }

    /** @return \App\Http\Entity\Pais[]  */
    public function findAll(): array
    {
        return $this->paisRepository->listOrderedByNome();
    }

    public function findById(int $id): Pais
    {
        return $this->paisRepository->findById($id);
    }

    public function save(Pais $pais): bool
    {
        PaisValidation::validatePais($pais);
        if(isset($pais->id)){
            return $this->update($pais);
        }

        return $this->insert($pais);
    }

    private function insert(Pais $pais): bool
    {
        return $this->paisRepository->add($pais, true);
    }

    private function update(Pais $pais): bool
    {
        return $this->paisRepository->update($pais, true);
    }

    public function delete(int $id): bool
    {
        $pais = $this->paisRepository->findById($id);
        
        if(is_null($pais)){
            return false;
        }
        
        return $this->paisRepository->delete($pais->id);
    }

}