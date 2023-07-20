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
    ) {
    }

    /** @return \App\Http\Entity\Estatistica[] */
    public function findAllByCampeonatoId(int $campId): array
    {
        $stmt = $this->pdo->prepare($this->sql->findAllByChampionshipId());
        $stmt->bindValue(':campeonato_id', $campId);
        $stmt->execute();

        return $this->hydrateEstatisticaList($stmt);
    }

    /** @return \App\Http\Entity\Estatistica[] */
    private function hydrateEstatisticaList(\PDOStatement $stmt): array
    {
        $estatisticaDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $estatisticaList = [];

        foreach ($estatisticaDataList as $estatisticaData) {
            
            $estatisticaData['pais'] = null;
            $estatisticaData['equipe'] = Equipe::fromList($estatisticaData, 'equipe_nome', 'equipe_sigla', 'equipe_pais_id', 'equipe_id');
            
            $estatisticaList[] = Estatistica::fromArray($estatisticaData);
        }
        return $estatisticaList;
    }
}