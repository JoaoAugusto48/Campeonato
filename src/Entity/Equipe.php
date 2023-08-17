<?php

namespace App\Http\Entity;

use App\Http\Entity\Pais;

class Equipe
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;
    public readonly int $paisId;
    public readonly ?Pais $pais;
    private bool $status;
    
    public function __construct(
        string $nome,
        string $sigla,
        int $paisId,
        ?int $id = null,
        ?Pais $pais = null,
    ){
        $this->nome = $nome;
        $this->sigla = $this->configureSigla($sigla);
        $this->paisId = $paisId;
        $this->id = $id;
        
        $this->pais = $pais;
    }
    
    public function getStatus():int{
        return $this->status;
    }
    
    public function setStatus(int $status):void{
        $this->status = $status;
    }

    public static function fromArray(
        array $equipeData, 
        string $nome = 'nome', 
        string $sigla = 'sigla', 
        string $paisId = 'pais_id', 
        ?string $id = 'id', 
        ?string $pais = 'pais'
    ): Equipe
    {
        if(!isset($equipeData[$pais])) {
            $equipeData[$pais] = null;
        }        

        return new Equipe(
            $equipeData[$nome], 
            $equipeData[$sigla], 
            $equipeData[$paisId],
            id: $equipeData[$id],
            pais: $equipeData[$pais],
        );
    }

    private function configureSigla(string $sigla): string
    {
        return strtoupper($sigla); 
    }

}
