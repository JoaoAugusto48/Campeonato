<?php

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Equipe;

final class EquipeValidation
{

    public static function validadeEquipe(Equipe $equipe): void
    {
        self::validateSigla($equipe->sigla);
    }

    private static function validateSigla(string $sigla): void
    {
        $size = 3;
        if(strlen($sigla) > $size) {
            throw new \PDOException("Sigla só pode ter até $size caracteres.");
        }

        if(strlen($sigla) === 0){
            throw new \RangeException('A sigla não pode ser nula.'); 
        }
    } 

}