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
        $stmt = $this->pdo->prepare($this->sql->update());
        $stmt->bindValue(':campeonatos_id', $partida->campeonatoId, PDO::PARAM_INT);
        $stmt->bindValue(':time_casa', $partida->timeCasaId, PDO::PARAM_INT);
        $stmt->bindValue(':time_visitante', $partida->timeVisitanteId, PDO::PARAM_INT);
        $stmt->bindValue(':num_gols_casa', $partida->numGolCasa, PDO::PARAM_INT);
        $stmt->bindValue(':num_gols_visitante', $partida->numGolVisitante, PDO::PARAM_INT);
        $stmt->bindValue(':rodada', $partida->rodada, PDO::PARAM_INT);
        $stmt->bindValue(':status', $partida->status, PDO::PARAM_BOOL);
        $stmt->bindValue(':id', $partida->id, PDO::PARAM_INT);
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
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydratePartida($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAllByCampeonatoId(int $campId): array
    {
        $stmt = $this->pdo->prepare($this->sql->findPartidasByChampionshipId());
        $stmt->bindValue(':campeonatoId', $campId, PDO::PARAM_INT);
        $stmt->execute();

        return $this->hydratePartidaList($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    /** @return \App\Http\Entity\Partida[] */
    public function findAllNotPlayedByCampeonatoIdRound(int $campId, int $round): array
    {
        $stmt = $this->pdo->prepare($this->sql->findPartidasNaoJogadasByChampionshipIdRound());
        $stmt->bindValue(':campeonatoId', $campId, PDO::PARAM_INT);
        $stmt->bindValue(':rodada', $round, PDO::PARAM_INT);
        $stmt->bindValue(':status', false, PDO::PARAM_BOOL);
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
            if(isset($partidaData['casa_nome']) && isset($partidaData['fora_nome'])){
                $partidaData['equipeCasa'] = Equipe::fromArray($partidaData, 'casa_nome', 'casa_sigla', 'casa_pais_id', 'casa_id');
                $partidaData['equipeVisitante'] = Equipe::fromArray($partidaData, 'fora_nome', 'fora_sigla', 'fora_pais_id', 'fora_id');
            }
            
            $partidaList[] = Partida::fromArray($partidaData);
        }

        return $partidaList;
    }

    private function hydratePartida(array $partidaData): Partida
    {
        return Partida::fromArray($partidaData);
    }
    
}