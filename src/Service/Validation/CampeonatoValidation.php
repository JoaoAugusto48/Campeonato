<?php

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Campeonato;

final class CampeonatoValidation
{

    public static function validadeCampeonato(Campeonato $campeonato): void
    {
        PatternValidation::validateString('Nome', $campeonato->nome);
    }

}