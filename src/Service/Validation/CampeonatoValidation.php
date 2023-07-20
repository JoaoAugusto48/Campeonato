<?php

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Campeonato;

final class CampeonatoValidation
{

    public static function validadeCampeonato(Campeonato $campeonato): void
    {
        self::validateNome($campeonato->nome);
    }

    private static function validateNome(string $nome): void
    {
        if(is_null($nome) || strlen($nome) === 0) {
            throw new \PDOException("O nome não pode ser nulo.");
        }
    }  

}