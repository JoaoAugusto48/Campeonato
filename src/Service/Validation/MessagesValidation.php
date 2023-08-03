<?php 

declare(strict_types=1);

namespace App\Http\Service\Validation;

class MessagesValidation
{

    public static function notNull(string $object): string 
    {
        return "$object não pode ser nulo.";
    }

    public static function notNegative(string $object): string 
    {
        return "$object, não pode ser negativo.";
    }

    public static function maxRange(string $object, int $size): string 
    {
        return "$object só pode ter até $size caracteres.";
    }
    
}