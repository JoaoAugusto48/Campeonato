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
        $stmt->bindValue(':nome', $campeonato->nome, PDO::PARAM_STR);
        $stmt->bindValue(':regiao', $campeonato->regiao, PDO::PARAM_STR);
        $stmt->bindValue(':num_fases', $campeonato->numFases, PDO::PARAM_INT);
        $stmt->bindValue(':num_equipes', $campeonato->numEquipes, PDO::PARAM_INT);
        $stmt->bindValue(':rodadas', $campeonato->rodadas, PDO::PARAM_INT);
        $stmt->bindValue(':num_turnos', $campeonato->numTurnos, PDO::PARAM_INT);
        $stmt->bindValue(':temporada', $campeonato->temporada, PDO::PARAM_STR);
        $result = $stmt->execute();
        
        return $result;
    }

    public function update(Campeonato $campeonato): bool
    {
        $stmt = $this->pdo->prepare($this->sql->update());
        $stmt->bindValue(':nome', $campeonato->nome, PDO::PARAM_STR);
        $stmt->bindValue(':regiao', $campeonato->regiao, PDO::PARAM_STR);
        $stmt->bindValue(':num_fases', $campeonato->numFases, PDO::PARAM_INT);
        $stmt->bindValue(':num_equipes', $campeonato->numEquipes, PDO::PARAM_INT);
        $stmt->bindValue(':rodadas', $campeonato->rodadas, PDO::PARAM_INT);
        $stmt->bindValue(':num_turnos', $campeonato->numTurnos, PDO::PARAM_INT);
        $stmt->bindValue(':temporada', $campeonato->temporada, PDO::PARAM_STR);
        $stmt->bindValue(':id', $campeonato->id, PDO::PARAM_INT);
        $stmt->bindValue(':rodada_atual', $campeonato->rodadaAtual, PDO::PARAM_INT);
        $stmt->bindValue(':ativado', $campeonato->ativado, PDO::PARAM_BOOL);
        $result = $stmt->execute();

        return $result;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare($this->sql->delete());
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        
        return $result;
    }

    public function findById(int $id): Campeonato
    {
        $stmt = $this->pdo->prepare($this->sql->findById());
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->hydrateCampeonato($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Campeonato[] */
    public function list(): array
    {
        $stmt = $this->pdo->prepare($this->sql->findAll());
        $stmt->execute();

        return $this->hydrateCampeonatoList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /**  @return \App\Http\Entity\Campeonato[] */
    private function hydrateCampeonatoList(array $campeonatoDataList): array
    {
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