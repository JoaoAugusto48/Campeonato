<?php 

declare(strict_types=1);

namespace App\Http\Enum;

enum Regiao: string
{
    case Regional = 'Regional';
    case Estadual = 'Estadual';
    case Nacional = 'Nacional';
    case Internacional = 'Internacional';
    case Mundial = 'Mundial';
}