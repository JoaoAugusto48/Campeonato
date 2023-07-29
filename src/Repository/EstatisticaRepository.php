<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Equipe;
use App\Http\Entity\Estatistica;
use App\Http\Repository\Sql\EstatisticaSql;
use PDO;

class EstatisticaRepository
{

    public function __construct(
        private PDO $pdo,
        private EstatisticaSql $sql,
    ){
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
        $stmt->bindValue(':campeonato_id', $campId);
        $stmt->bindValue(':equipe1_id', $equipe1Id);
        $stmt->bindValue(':equipe2_id', $equipe2Id);
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