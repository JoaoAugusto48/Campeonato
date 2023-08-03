<?php 

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Partida;

final class PartidaValidation
{

    public static function validatePartida(Partida $partida): void
    {
        PatternValidation::validateNegative('Gol casa', $partida->numGolCasa);
        PatternValidation::validateNegative('Gol fora', $partida->numGolVisitante);
    }

}