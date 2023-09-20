<?php 

declare(strict_types=1);

namespace App\Http\DTO;

class CampeonatoFormDTO 
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $regiao;
    public readonly int $numFases;
    public readonly int $numEquipes;
    public readonly string $temporada;
    public readonly ?int $rodadas;
    public readonly int $numTurnos;

    /**
     * @param array|object|null $requestParsedBody
     */
    public function __construct(array $requestParsedBody, ?int $id = null) {

        $this->nome = $requestParsedBody['nome'];
        $this->regiao = isset($requestParsedBody['regiao']) ? $requestParsedBody['regiao'] : '';
        $this->numFases = 1;
        $this->numEquipes = intval($requestParsedBody['equipes']);
        $this->temporada = $requestParsedBody['temporada'];
        $this->numTurnos = intval($requestParsedBody['turnos']);
        $this->rodadas = ($requestParsedBody['rodadas'] ?? null);
        
        $this->id = $id;
    }

}