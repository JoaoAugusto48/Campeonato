<?php

declare(strict_types=1);

namespace App\Http\Repository\Sql;

class EstatisticaSql
{

    public function findAllByChampionshipId() 
    {
        return 'SELECT es.id, 
                    es.vitorias, 
                    es.empates, 
                    es.derrotas, 
                    es.gols_pro, 
                    es.gols_contra, 
                    es.equipes_id, 
                    es.campeonatos_id,
                    eq.id as equipe_id,
                    eq.nome as equipe_nome, 
                    eq.sigla as equipe_sigla,
                    eq.pais_id as equipe_pais_id
                FROM estatisticas AS es
                JOIN equipes AS eq 
                WHERE 
                    es.equipes_id=eq.id 
                AND es.campeonatos_id=:campeonato_id';
    }

    public function findByChampionshipAndEquipesId() 
    {
        return 'SELECT es.id, 
                    es.vitorias, 
                    es.empates, 
                    es.derrotas, 
                    es.gols_pro, 
                    es.gols_contra, 
                    es.equipes_id, 
                    es.campeonatos_id,
                    eq.id as equipe_id,
                    eq.nome as equipe_nome, 
                    eq.sigla as equipe_sigla,
                    eq.pais_id as equipe_pais_id
                FROM estatisticas AS es
                JOIN equipes AS eq 
                WHERE 
                    es.equipes_id=eq.id 
                AND es.campeonatos_id=:campeonato_id
                AND (es.equipes_id=:equipe1_id OR es.equipes_id=:equipe2_id);';
    }
    
}