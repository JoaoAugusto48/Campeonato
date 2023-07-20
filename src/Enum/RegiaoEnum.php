<?php 

declare(strict_types=1);

namespace App\Http\Enum;

enum RegiaoEnum
{
    case Municipal;
    case Regional;
    case Estadual;
    case Nacional;
    case Internacional;
    case Mundial;
}