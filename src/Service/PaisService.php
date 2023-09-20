<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Pais;
use App\Http\Repository\PaisRepository;
use App\Http\Service\Validation\PaisValidation;

class PaisService
{

    public function __construct(
        private PaisRepository $paisRepository,
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

    public function save(Pais $pais, bool $flush = true): void
    {
        PaisValidation::validatePais($pais);
        if(!is_null($pais->getId())){
            $this->update($pais, $flush);
        }
        $this->insert($pais, $flush);
    }

    private function insert(Pais $pais, bool $flush): void
    {
        $this->paisRepository->add($pais, $flush);
    }

    private function update(Pais $pais, bool $flush): void
    {
        $this->paisRepository->update($pais, $flush);
    }

    /**
     * @throws \RuntimeException
     */
    public function delete(int $id): void
    {
        $pais = $this->paisRepository->findById($id);
        
        if(is_null($pais)){
            throw new \RuntimeException('País inexistente.');
        }
        
        $this->paisRepository->delete($pais->getId(), true);
    }

}