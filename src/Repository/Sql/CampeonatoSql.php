<?php 

declare(strict_types=1);

namespace App\Http\Repository\Sql;

class CampeonatoSql 
{

    public function insert(): string
    {
        return 'INSERT INTO campeonatos 
                    (
                        nome, 
                        regiao, 
                        num_fases, 
                        num_equipes, 
                        rodadas, 
                        num_turnos
                    ) 
                VALUE 
                    (
                        :nome, 
                        :regiao, 
                        :num_fases, 
                        :num_equipes, 
                        :rodadas, 
                        :num_turnos
                    )
                ;';
    }

}

