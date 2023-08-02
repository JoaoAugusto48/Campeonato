<?php

declare(strict_types=1);

namespace App\Http\Repository\Sql;

class EstatisticaSql
{

    public function updateTwo(): string
    {
        return 'UPDATE estatisticas SET 
                    vitorias= CASE 
                        WHEN id = :id THEN :vitorias
                        WHEN id = :id2 THEN :vitorias2
                        ELSE vitorias
                    END,
                    empates= CASE 
                        WHEN id = :id THEN :empates
                        WHEN id = :id2 THEN :empates2
                        ELSE empates
                    END,
                    derrotas= CASE 
                        WHEN id = :id THEN :derrotas
                        WHEN id = :id2 THEN :derrotas2
                        ELSE derrotas
                    END,
                    gols_pro= CASE 
                        WHEN id = :id THEN :gols_pro
                        WHEN id = :id2 THEN :gols_pro2
                        ELSE gols_pro
                    END,
                    gols_contra= CASE 
                        WHEN id = :id THEN :gols_contra
                        WHEN id = :id2 THEN :gols_contra2
                        ELSE gols_contra
                    END
                WHERE id IN (:id, :id2);';


        // return 'UPDATE estatisticas
        //         SET vitorias=:vitorias,
        //             empates=:empates,
        //             derrotas=:derrotas,
        //             gols_pro=:gols_pro,
        //             gols_contra=:gols_contra
        //         WHERE id=:id;';
    }

    public function findAllByChampionshipId(): string
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

    public function findByChampionshipAndEquipesId(): string
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