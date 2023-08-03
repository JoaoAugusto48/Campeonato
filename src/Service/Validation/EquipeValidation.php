<?php

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Equipe;

final class EquipeValidation
{
    private static int $maxRange = 3;

    public static function validadeEquipe(Equipe $equipe): void
    {
        PatternValidation::validateString('Nome', $equipe->nome);
        self::validateSigla($equipe->sigla);
    }

    /** @throws \PDOException */
    private static function validateSigla(string $sigla): void
    {
        PatternValidation::validateMaxRange('Sigla', self::$maxRange);
        PatternValidation::validateString('Sigla', $sigla);
    } 

}