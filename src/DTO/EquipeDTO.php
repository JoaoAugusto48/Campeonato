<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Equipe;

class EquipeDTO 
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;
    public readonly int $paisId;
    public readonly ?PaisDTO $pais;

    public function __construct(Equipe $equipe) 
    {
        $this->id = $equipe->getId();   
        $this->nome = $equipe->getNome();   
        $this->sigla = $equipe->getSigla();   
        $this->paisId = $equipe->getPaisId();   
        $this->pais = PaisDTO::getPaisDTO($equipe->getPais());   
    }

    /**
     * @param Equipe[] $equipeList
     * @return EquipeDTO[]
     */
    public static function equipeDTOList(array $equipeList): array
    {
        $equipes = [];
        foreach ($equipeList as $equipe) {
            $equipes[] = new EquipeDTO($equipe);
        }
        
        return $equipes;
    }

    public static function getEquipeDTO(Equipe $equipe): EquipeDTO
    {
        return new EquipeDTO($equipe);
    }
}