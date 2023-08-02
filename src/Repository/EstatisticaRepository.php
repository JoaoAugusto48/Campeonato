<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Equipe;
use App\Http\Entity\Estatistica;
use App\Http\Repository\Sql\EstatisticaSql;
use PDO;
use PDOStatement;

class EstatisticaRepository
{

    public function __construct(
        private PDO $pdo,
        private EstatisticaSql $sql,
    ){
    }

    /** @param \App\Http\Entity\Estatistica[] $estatisticaList */
    public function updateTwo(array $estatisticaList): bool
    {
        if(sizeof($estatisticaList) !== 2) {
            return false;
        }
        $stmt = $this->pdo->prepare($this->sql->updateTwo());
        $stmt->bindValue(':vitorias', $estatisticaList[0]->vitorias, PDO::PARAM_INT);
        $stmt->bindValue(':empates', $estatisticaList[0]->empates, PDO::PARAM_INT);
        $stmt->bindValue(':derrotas', $estatisticaList[0]->derrotas, PDO::PARAM_INT);
        $stmt->bindValue(':gols_pro', $estatisticaList[0]->golsPro, PDO::PARAM_INT);
        $stmt->bindValue(':gols_contra', $estatisticaList[0]->golsContra, PDO::PARAM_INT);
        $stmt->bindValue(':id', $estatisticaList[0]->id, PDO::PARAM_INT);
        
        $stmt->bindValue(':vitorias2', $estatisticaList[1]->vitorias, PDO::PARAM_INT);
        $stmt->bindValue(':empates2', $estatisticaList[1]->empates, PDO::PARAM_INT);
        $stmt->bindValue(':derrotas2', $estatisticaList[1]->derrotas, PDO::PARAM_INT);
        $stmt->bindValue(':gols_pro2', $estatisticaList[1]->golsPro, PDO::PARAM_INT);
        $stmt->bindValue(':gols_contra2', $estatisticaList[1]->golsContra, PDO::PARAM_INT);
        $stmt->bindValue(':id2', $estatisticaList[1]->id, PDO::PARAM_INT);
        
        $result = $stmt->execute();

        return $result;
    }

    public function findAllByCampeonatoId(int $campId): array
    {
        $stmt = $this->pdo->prepare($this->sql->findAllByChampionshipId());
        $stmt->bindValue(':campeonato_id', $campId);
        $stmt->execute();

        return $this->hydrateEstatisticaList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function findByCampeonatoEquipesId(int $campId, int $equipe1Id, int $equipe2Id): array
    {
        $stmt = $this->pdo->prepare($this->sql->findByChampionshipAndEquipesId());
        $stmt->bindValue(':campeonato_id', $campId, PDO::PARAM_INT);
        $stmt->bindValue(':equipe1_id', $equipe1Id, PDO::PARAM_INT);
        $stmt->bindValue(':equipe2_id', $equipe2Id, PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydrateEstatisticaList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Estatistica[] */
    public function hydrateEstatisticaList(array $estatisticaDataList): array
    {
        $estatisticaList = [];

        foreach ($estatisticaDataList as $estatisticaData){
            $estatisticaData['equipe'] = Equipe::fromArray($estatisticaData, 'equipe_nome', 'equipe_sigla', 'equipe_pais_id', 'equipe_id');

            $estatisticaList[] = Estatistica::fromArray($estatisticaData);
        }

        return $estatisticaList;
    }
}