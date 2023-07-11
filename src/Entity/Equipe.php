<?php

namespace App\Http\Entity;

use App\Http\Entity\Pais;
use App\Http\Service\PaisService;

class Equipe{
    public ?int $id;
    public readonly string $nome;
    public readonly string $sigla;
    public readonly Pais $pais;
    private bool $status;
    
    
    public function __construct(
        string $nome,
        string $sigla,
        Pais $pais,
        ?int $id = null,
    ){
        $this->nome = $nome;
        $this->sigla = $this->configureSigla($sigla);
        $this->pais = $pais;
        $this->id = $id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function getStatus():int{
        return $this->status;
    }
    
    public function setStatus(int $status):void{
        $this->status = $status;
    }

    public static function fromList(array $equipeData, string $nome = 'nome', string $sigla = 'sigla', string $pais = 'pais', ?string $id = 'id'): Equipe
    {
        $equipe = new Equipe(
            $equipeData[$nome], 
            $equipeData[$sigla], 
            $equipeData[$pais],
            $equipeData[$id]
        );

        return $equipe;
    }

    private function configureSigla(string $sigla): string
    {
        return strtoupper($sigla); 
    }

}
