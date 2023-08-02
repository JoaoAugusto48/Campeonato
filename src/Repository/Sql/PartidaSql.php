<?php 

declare(strict_types=1);

namespace App\Http\Repository\Sql;

class PartidaSql
{

    public function update(): string
    {
        return 'UPDATE partidas 
                SET campeonatos_id=:campeonatos_id,
                    time_casa=:time_casa,
                    time_visitante=:time_visitante,
                    num_gols_casa=:num_gols_casa,
                    num_gols_visitante=:num_gols_visitante,
                    rodada=:rodada,
                    status=:status
                WHERE
                    id=:id';
    }

    public function findPartidasByChampionshipId(): string
    {
        return 'SELECT p.id, 
                    p.campeonatos_id, 
                    p.time_casa, 
                    p.time_visitante, 
                    p.num_gols_casa, 
                    p.num_gols_visitante, 
                    p.rodada,
                    p.status,
                    c.id AS casa_id, 
                    c.nome AS casa_nome, 
                    c.pais_id AS casa_pais_id, 
                    c.sigla AS casa_sigla, 
                    f.id AS fora_id, 
                    f.nome AS fora_nome, 
                    f.pais_id AS fora_pais_id, 
                    f.sigla AS fora_sigla
                FROM partidas AS p 
                    JOIN equipes AS c 
                    JOIN equipes AS f
                WHERE p.time_casa=c.id 
                    AND p.time_visitante=f.id 
                    AND p.campeonatos_id=:campeonatoId;';
    }

    public function findPartidasNaoJogadasByChampionshipIdRound(): string
    {
        return 'SELECT id, 
                    campeonatos_id, 
                    time_casa, 
                    time_visitante, 
                    num_gols_casa, 
                    num_gols_visitante, 
                    rodada,
                    status
                FROM partidas 
                WHERE campeonatos_id=:campeonatoId
                    AND rodada=:rodada
                    AND status=:status;';
    }

    public function findPartidaById(): string
    {
        return 'SELECT id,
                    campeonatos_id, 
                    time_casa, 
                    time_visitante, 
                    num_gols_casa, 
                    num_gols_visitante, 
                    rodada,
                    status
                FROM partidas
                WHERE id=:id';
    }

}