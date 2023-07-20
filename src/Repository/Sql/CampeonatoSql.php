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
                        num_turnos,
                        temporada
                    ) 
                VALUE 
                    (
                        :nome, 
                        :regiao, 
                        :num_fases, 
                        :num_equipes, 
                        :rodadas, 
                        :num_turnos,
                        :temporada
                    )
                ;';
    }

    public function update(): string
    {
        return 'UPDATE campeonatos SET
                    nome=:nome,
                    regiao=:regiao,
                    num_fases=:num_fases,
                    num_equipes=:num_equipes,
                    rodadas=:rodadas,
                    num_turnos=:num_turnos,
                    temporada=:temporada
                WHERE
                    id=:id;';
    }

    public function delete(): string
    {
        return 'DELETE FROM campeonatos WHERE id=:id';
    }

    public function findAll(): string
    {
        return 'SELECT id,
                    nome, 
                    regiao, 
                    num_fases, 
                    num_equipes, 
                    rodadas, 
                    num_turnos,
                    temporada,
                    ativado
                FROM campeonatos';
    }

    public function findById(): string
    {
        return 'SELECT id,
                    nome, 
                    regiao, 
                    num_fases, 
                    num_equipes, 
                    rodadas, 
                    num_turnos,
                    temporada,
                    ativado
                FROM campeonatos
                WHERE id=:id';
    }

}

