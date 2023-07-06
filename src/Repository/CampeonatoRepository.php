<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Campeonato;
use PDO;

class CampeonatoRepository
{

    public function __construct(private PDO $pdo) 
    {
    }

    public function add($example): bool
    {
        return false;
    }

    public function update($example): bool
    {
        return false;
    }

    public function delete($example): bool
    {
        return false;
    }

    public function findById(int $id)
    {
        return;
    }

    /** @return \App\Http\Entity\Campeonato[] */
    public function list(): array
    {
        $sql = 'SELECT * FROM campeonatos;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $this->hydrateCampeonatoList($stmt);
    }

    /**  @return \App\Http\Entity\Campeonato[] */
    private function hydrateCampeonatoList(\PDOStatement $stmt): array
    {
        $campeonatoDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $campeonatoList = [];

        foreach($campeonatoDataList as $campeonatoData) {
            $campeonato = new Campeonato($campeonatoData['nome'], $campeonatoData['turno'], $campeonatoData['qtde_equipes']);
            $campeonato->setId($campeonatoData['id']);
            $campeonatoList[] = $campeonato;
        }

        return $campeonatoList;
    }
    

}