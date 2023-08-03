<?php 

declare(strict_types=1);

namespace App\Http\Service\Validation;

class PatternValidation
{

    /** @throws \RangeException */
    public static function validateString(string $object, string $nome): void
    {
        if(is_null($nome) || strlen($nome) === 0){
            throw new \RangeException(MessagesValidation::notNull($object));
        }
    }

    /** @throws \RangeException */
    public static function validateNegative(string $object, int $number): void
    {
        if($number < 0) {
            throw new \RangeException(MessagesValidation::notNegative($object));
        }
    }

    /** @throws \RangeException */
    public static function validateMaxRange(string $object, int $number): void
    {
        if($number < 0) {
            throw new \RangeException(MessagesValidation::maxRange($object, $number));
        }
    }

}