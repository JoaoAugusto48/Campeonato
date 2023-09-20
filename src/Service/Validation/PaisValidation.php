<?php 

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Pais;

final class PaisValidation
{
    private static int $maxRange = 3;

    public static function validatePais(Pais $pais): void
    {
        PatternValidation::validateString('Nome', $pais->getNome());
        self::validateSigla($pais->getSigla());
    }

    /** @throws \PDOException */
    private static function validateSigla(string $sigla): void 
    {
        PatternValidation::validateMaxRange('Sigla', self::$maxRange);
        PatternValidation::validateString('Sigla', $sigla);
    }

}