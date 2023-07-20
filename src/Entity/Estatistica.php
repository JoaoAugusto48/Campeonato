<?php

namespace App\Http\Entity;

use App\Http\Entity\Campeonato;
use App\Http\Entity\Equipe;
use App\Http\Enum\PontosEnum;

class Estatistica
{
    public readonly int $id;
    public readonly int $vitorias;
    public readonly int $empates;
    public readonly int $derrotas;
    public readonly int $golsPro;
    public readonly int $golsContra;
    public readonly int $pontos; // criado apenas para mostrar os pontos
    public readonly int $saldoGols; // criado apenas para mostrar o Saldo
    public readonly int $jogos; // criado apenas para mostrar a qtde de Jogos

    public readonly int $equipeId;
    public readonly int $campeonatoId;

    public readonly Campeonato $campeonato;
    public readonly ?Equipe $equipe;
    
    public function __construct(
        int $vitorias,
        int $empates,
        int $derrotas,
        int $golsPro,
        int $golsContra,
        int $campeonatoId,
        int $equipeId,
        ?int $id = null,
        ?Equipe $equipe = null,
    ){
        $this->vitorias = $vitorias;
        $this->empates = $empates;
        $this->derrotas = $derrotas;
        $this->golsPro = $golsPro;
        $this->golsContra = $golsContra;
        $this->campeonatoId = $campeonatoId;
        $this->equipeId = $equipeId;
        $this->pontos = $this->definePontos($this->vitorias, $this->empates, $this->derrotas);
        $this->saldoGols = $this->defineSaldo($this->golsPro, $this->golsContra);
        $this->jogos = $this->defineJogos($this->vitorias, $this->empates, $this->derrotas);
        
        $this->id = $id;
        $this->equipe = $equipe;
    }

    private function definePontos(int $vitorias, int $empates, int $derrotas): int
    {
        return (PontosEnum::Vitoria->value * $vitorias) + (PontosEnum::Empate->value * $empates) + (PontosEnum::Derrota->value * $derrotas);
    }

    private function defineSaldo(int $golPro, int $golContra): int
    {
        return $golPro - $golContra;
    }

    private function defineJogos(int $vitorias, int $empates, int $derrotas): int
    {
        return $vitorias + $empates + $derrotas;
    }

    /** @return  */
    public static function fromArray(
        array $estatisticaData,
        string $vitorias = 'vitorias',
        string $empates = 'empates',
        string $derrotas = 'derrotas',
        string $golsPro = 'gols_pro',
        string $golsContra = 'gols_contra',
        string $campeonatoId = 'campeonatos_id',
        string $equipeId = 'equipes_id',
        ?string $id = 'id',
        ?string $equipe = 'equipe',
    ): Estatistica
    {
        return new Estatistica(
            $estatisticaData[$vitorias],
            $estatisticaData[$empates],
            $estatisticaData[$derrotas],
            $estatisticaData[$golsPro],
            $estatisticaData[$golsContra],
            $estatisticaData[$campeonatoId],
            $estatisticaData[$equipeId],
            $estatisticaData[$id],
            $estatisticaData[$equipe],
        );
    }

}
