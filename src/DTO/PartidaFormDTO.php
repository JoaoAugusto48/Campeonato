<?php

declare(strict_types=1);

namespace App\Http\DTO;

class PartidaFormDTO
{
    public readonly ?int $id;
    public readonly int $numGolCasa;
    public readonly int $numGolVisitante;
    public readonly ?int $timeCasaId;
    public readonly ?int $timeVisitanteId;

    public function __construct(array $requestParsedBody, ?int $timeCasaId = null, ?int $timeVisitanteId = null, ?int $id = null) {

        $this->numGolCasa = intval($requestParsedBody['golsCasa']);
        $this->numGolVisitante = intval($requestParsedBody['golsFora']);
        $this->timeCasaId = $timeCasaId;
        $this->timeVisitanteId = $timeVisitanteId;
        
        $this->id = $id;
    }

}