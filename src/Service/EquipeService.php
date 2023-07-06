<?php 

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Equipe;
use App\Http\Repository\EquipeRepository;

class EquipeService
{
    public function __construct(
        private EquipeRepository $equipeRepository,
        private PaisService $paisService
    ) {
    }

    /** @return \App\Http\Entity\Equipe[] */
    public function findAll(): array
    {
        return $this->equipeRepository->list();
    }

    public function findById(int $id): Equipe
    {
        return $this->equipeRepository->findById($id);
    }

    public function insert(Equipe $equipe): bool
    {
        $pais = $this->paisService->findById($equipe->pais->id);
        
        if(is_null($pais)) {
            return false;
        }

        return $this->equipeRepository->add($equipe);   
    }

    public function update(Equipe $equipe): bool
    {
        $pais = $this->paisService->findById($equipe->pais->id);

        if(is_null($pais)) {
            return false;
        }

        return $this->equipeRepository->update($equipe);
    }

    public function delete(int $id): bool
    {
        $equipe = $this->equipeRepository->findById($id);

        if(is_null($equipe)){
            return false;
        }

        return $this->equipeRepository->delete($equipe->id);
    }

}