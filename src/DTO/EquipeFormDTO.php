<?php 

declare(strict_types=1);

namespace App\Http\DTO;

class EquipeFormDTO 
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;
    public readonly int $paisId;
    // public readonly ?PaisDTO $pais;

    public function __construct(array $requestParsedBody, ?int $id = null) 
    {
        $this->nome = $requestParsedBody['nome'];
        $this->sigla = $requestParsedBody['sigla'];
        $this->paisId = intval($requestParsedBody['pais']);
        
        $this->id = $id;
    }

}