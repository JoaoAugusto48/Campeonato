<?php

declare(strict_types=1);

namespace App\Http\Repository\Sql;

class PaisSql
{

    public function insert(): string
    {
        return 'INSERT INTO pais (nome, sigla, status) VALUE (:nome, :sigla, :status)';
    }

    public function update(): string
    {
        return 'UPDATE pais 
                SET nome=:nome, 
                    sigla=:sigla 
                WHERE 
                    id=:id;';
    }

    public function delete(): string
    {
        return 'UPDATE pais SET 
                    status=:status 
                WHERE 
                    id=:id;';
    }

    public function findById(): string
    {
        return 'SELECT 
                    id, 
                    nome, 
                    sigla 
                FROM pais 
                WHERE 
                    id=:id';
    }

    public function findAll(): string
    {
        return 'SELECT 
                    id, 
                    nome, 
                    sigla 
                FROM pais 
                WHERE 
                    status=1 
                ORDER BY nome';
    }

}