<?php 

declare(strict_types=1);

namespace App\Http\Service\Validation;

use App\Http\Entity\Pais;

final class PaisValidation
{

    public static function validatePais(Pais $pais): void
    {
        self::validateNome($pais->nome);
        self::validateSigla($pais->sigla);
    }

    /** @throws \PDOException */
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

    /** @throws \RangeException */
    private static function validateNome(string $nome): void
    {
        if(is_null($nome) || strlen($nome) === 0){
            throw new \RangeException('O nome não pode ser nulo.');
        }
    }

}