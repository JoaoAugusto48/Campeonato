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
        $stmt->bindValue(':temporada', $campeonato->temporada);
        $result = $stmt->execute();
        
        return $result;
    }

    public function update(Campeonato $campeonato): bool
    {
        $stmt = $this->pdo->prepare($this->sql->update());
        $stmt->bindValue(':nome', $campeonato->nome);
        $stmt->bindValue(':regiao', $campeonato->regiao);
        $stmt->bindValue(':num_fases', $campeonato->numFases);
        $stmt->bindValue(':num_equipes', $campeonato->numEquipes);
        $stmt->bindValue(':rodadas', $campeonato->rodadas);
        $stmt->bindValue(':num_turnos', $campeonato->numTurnos);
        $stmt->bindValue(':temporada', $campeonato->temporada);
        $stmt->bindValue(':id', $campeonato->id);
        $result = $stmt->execute();

        return $result;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare($this->sql->delete());
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();
        
        return $result;
    }

    public function findById(int $id): Campeonato
    {
        $stmt = $this->pdo->prepare($this->sql->findById());
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $this->hydrateCampeonato($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Campeonato[] */
    public function list(): array
    {
        $stmt = $this->pdo->prepare($this->sql->findAll());
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

    private function hydrateCampeonato(array $campeonatoData): Campeonato
    {
        return Campeonato::fromArray($campeonatoData);
    }
    

}