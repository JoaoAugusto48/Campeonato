<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Pais;

class EquipePartidaDTO
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;
    public readonly ?int $gols;
    public readonly ?int $paisId;
    public readonly ?Pais $pais;

    public function __construct(
        string $nome,
        string $sigla,
        ?int $gols = null,
        ?int $id = null,
        ?int $paisId = null,
        ?Pais $pais = null,
    ) { 
        $this->nome = $nome;
        $this->sigla = $sigla;
        $this->gols = $gols;
        $this->id = $id;
        $this->paisId = $paisId;
        $this->pais = $pais;
    }

}