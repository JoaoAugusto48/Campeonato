<?php

namespace App\Http\Entity;

class Usuario{
    public readonly int $id;
    public readonly string $nome;
    public readonly string $user;
    public readonly string $senha;

    public function __construct(string $nome, string $user, string $senha)
    {
        $this->nome = $nome;
        $this->user = $user;
        $this->senha = $senha;
    }

    public function getSenha():string
    {
        return $this->senha;
    }

    public function setId(int $id):void{
        $this->id = $id;
    }
    
}
