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

    public function update(Partida $partida): bool
    {
        // var_dump($partida);
        // exit;
        $stmt = $this->pdo->prepare($this->sql->update());
        $stmt->bindValue(':campeonatos_id', $partida->campeonatoId);
        $stmt->bindValue(':time_casa', $partida->timeCasaId);
        $stmt->bindValue(':time_visitante', $partida->timeVisitanteId);
        $stmt->bindValue(':num_gols_casa', $partida->numGolCasa);
        $stmt->bindValue(':num_gols_visitante', $partida->numGolVisitante);
        $stmt->bindValue(':rodada', $partida->rodada);
        $stmt->bindValue(':status', $partida->status);
        $stmt->bindValue(':id', $partida->id);
        $result = $stmt->execute();
        
        return $result;
    }

    public function delete(int $id): bool
    {
        return false;
    }

    public function findById(int $id)
    {
        $stmt = $this->pdo->prepare($this->sql->findPartidaById());
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $this->hydratePartida($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAllByCampeonatoId(int $campId): array
    {
        $stmt = $this->pdo->prepare($this->sql->findPartidasByChampionship());
        $stmt->bindValue(':campeonatoId', $campId);
        $stmt->execute();

        return $this->hydratePartidaList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Partida[] */
    public function list(): array
    {
        return array();
    }

    /** @return \App\Http\Entity\Partida[] */
    private function hydratePartidaList(array $partidaDataList): array
    {
        $partidaList = [];

        foreach ($partidaDataList as $partidaData) {
            $partidaData['equipeCasa'] = Equipe::fromArray($partidaData, 'casa_nome', 'casa_sigla', 'casa_pais_id', 'casa_id');
            $partidaData['equipeVisitante'] = Equipe::fromArray($partidaData, 'fora_nome', 'fora_sigla', 'fora_pais_id', 'fora_id');
            
            $partidaList[] = Partida::fromArray($partidaData);
        }

        return $partidaList;
    }

    private function hydratePartida(array $partidaData): Partida
    {
        return Partida::fromArray($partidaData);
    }
    
}