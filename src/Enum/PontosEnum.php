<?php 

declare(strict_types=1);

namespace App\Http\Enum;

enum PontosEnum: int
{
    case Vitoria = 3;
    case Empate = 1;
    case Derrota = 0;
}