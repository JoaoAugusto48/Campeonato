<?php

namespace App\Http\Entity;

use App\Http\Entity\Pais;

class Equipe{
    public int $id;
    public readonly string $nome;
    public readonly string $sigla;
    public readonly Pais $pais;
    private bool $status;
    
    
    public function __construct(
        string $nome,
        string $sigla,
        Pais $pais
    ){
        $this->nome = $nome;
        $this->sigla = $sigla;
        $this->pais = $pais;
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

}
