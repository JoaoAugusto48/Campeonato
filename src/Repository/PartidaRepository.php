<?php

declare(strict_types=1);

namespace App\Http\Repository;

use App\Http\Entity\Equipe;
use App\Http\Entity\Partida;
use App\Http\Repository\Sql\PartidaSql;
use PDO;

class PartidaRepository
{

    public function __construct(
        private PDO $pdo,
        private PartidaSql $sql,
    ) {
    }

    public function add($example): bool
    {
        return false;
    }

    public function update($example): bool
    {
        return false;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function findById(int $id)
    {
        return;
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAllByCampeonatoId(int $campId): array
    {
        $stmt = $this->pdo->prepare($this->sql->findPartidasByChampionship());
        $stmt->bindValue(':campeonatoId', $campId);
        $stmt->execute();

        return $this->hydratePartidaList($stmt);
    }

    /** @return \App\Http\Entity\Partida[] */
    public function list(): array
    {
        return array();
    }

    /** @return \App\Http\Entity\Partida[] */
    private function hydratePartidaList(\PDOStatement $stmt): array
    {
        $partidaDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $partidaList = [];

        foreach ($partidaDataList as $partidaData) {
            $partidaData['equipeCasa'] = Equipe::fromArray($partidaData, 'casa_nome', 'casa_sigla', 'casa_pais_id', 'casa_id');
            $partidaData['equipeVisitante'] = Equipe::fromArray($partidaData, 'fora_nome', 'fora_sigla', 'fora_pais_id', 'fora_id');
            
            $partidaList[] = Partida::fromArray($partidaData);
        }

        return $partidaList;
    }
    
}