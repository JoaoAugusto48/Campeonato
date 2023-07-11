<?php 

declare(strict_types=1);

namespace App\Http\Repository\Sql;

class EquipeSql
{

    public function insert(): string
    {
        return 'INSERT INTO equipes (nome, sigla, pais_id) VALUE (:nome, :sigla, :pais_id);';
    }

    public function update(): string
    {
        return 'UPDATE equipes SET 
                    nome=:nome, 
                    sigla=:sigla, 
                    pais_id=:pais_id 
                WHERE 
                    id=:id;';
    }

    public function delete(): string
    {
        return 'DELETE FROM equipes WHERE id=:id;';
    }

    public function findById(): string
    {
        return 'SELECT 
                    id, 
                    nome, 
                    sigla, 
                    pais_id 
                FROM equipes 
                WHERE 
                    id=:id;';
    }

    public function findAllWithPais(): string
    {
        return 'SELECT 
                    e.id, 
                    e.nome, 
                    e.sigla, 
                    e.pais_id, 
                    p.id as pais_id, 
                    p.nome as pais_nome, 
                    p.sigla as pais_sigla 
                FROM equipes as e 
                JOIN pais as p 
                WHERE 
                    e.pais_id = p.id 
                ORDER BY e.nome;';
    }

}