<?php 

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Estatistica;

class EstatisticaValidation
{

    public static function validaEstatistica(Estatistica $estatistica): void
    {
        PatternValidation::validateNegative('Vitória', $estatistica->vitorias);
        PatternValidation::validateNegative('Empate', $estatistica->empates);
        PatternValidation::validateNegative('Derrota', $estatistica->derrotas);
        PatternValidation::validateNegative('Gol pró', $estatistica->golsPro);
        PatternValidation::validateNegative('Gol contra', $estatistica->golsContra);
    }
}