<?php 

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Estatistica;

class EstatisticaValidation
{

    public static function validaEstatistica(Estatistica $estatistica): void
    {
        self::validateVitorias($estatistica->vitorias);
    }

    private static function validateVitorias(int $vitorias): void
    {
        if($vitorias < 0) {
            throw new \RangeException("Vitórias não podem ser negativas.");
        }
    }

}