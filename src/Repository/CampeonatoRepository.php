<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Campeonato;
use App\Http\Repository\Sql\CampeonatoSql;
use PDO;

class CampeonatoRepository
{

    public function __construct(
        private PDO $pdo,
        private CampeonatoSql $sql
    ) {
    }

    public function add(Campeonato $campeonato): bool
    {
        $stmt = $this->pdo->prepare($this->sql->insert());
        $stmt->bindValue(':nome', $campeonato->nome);
        $stmt->bindValue(':regiao', $campeonato->regiao);
        $stmt->bindValue(':num_fases', $campeonato->numFases);
        $stmt->bindValue(':num_equipes', $campeonato->numEquipes);
        $stmt->bindValue(':rodadas', $campeonato->rodadas);
        $stmt->bindValue(':num_turnos', $campeonato->numTurnos);
        $result = $stmt->execute();
        
        return $result;
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
            $campeonatoList[] = Campeonato::fromArray($campeonatoData);
        }

        return $campeonatoList;
    }
    

}