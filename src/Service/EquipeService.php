<?php 

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Entity\Equipe;
use App\Http\Repository\EquipeRepository;
use App\Http\Service\Validation\EquipeValidation;

class EquipeService
{
    public function __construct(
        private EquipeRepository $equipeRepository,
        private PaisService $paisService,
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

    public function save(Equipe $equipe): bool
    {
        $pais = $this->paisService->findById($equipe->paisId);
        $equipe->setPais($pais);

        // EquipeValidation::validadeEquipe($equipe);
        if(isset($equipe->id)){
            return $this->update($equipe);
        }

        return $this->insert($equipe);
    }

    private function insert(Equipe $equipe): bool
    {
        $pais = $this->paisService->findById($equipe->paisId);
        
        if(is_null($pais)) {
            return false;
        }

        return $this->equipeRepository->add($equipe, true);   
    }

    private function update(Equipe $equipe): bool
    {
        $pais = $this->paisService->findById($equipe->paisId);
        
        if(is_null($pais)) {
            return false;
        }

        return $this->equipeRepository->update($equipe, true);
    }

    public function delete(int $id, $flush=false): bool
    {
        $equipe = $this->equipeRepository->findById($id);

        if(is_null($equipe)){
            return false;
        }

        return $this->equipeRepository->delete($equipe->id);
    }

}