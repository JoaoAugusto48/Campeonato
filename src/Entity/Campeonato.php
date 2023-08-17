<?php

namespace App\Http\Entity;

class Campeonato{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $regiao;
    public readonly int $numFases;
    public readonly int $numEquipes;
    public readonly string $temporada;
    public readonly ?int $rodadas;
    public readonly ?int $rodadaAtual;
    public readonly int $numTurnos;
    public readonly bool $ativado;

    public function __construct(string $nome, string $regiao, int $numFases, int $numEquipes, int $numTurnos, string $temporada, ?int $rodadas = null, ?int $rodadaAtual = 1, ?int $id = null, ?bool $ativado = null) 
    {
        $this->nome = $nome;
        $this->regiao = $regiao;
        $this->numFases = $numFases;
        $this->numEquipes = $numEquipes;
        $this->numTurnos = $numTurnos;
        $this->temporada = $temporada;
        $this->rodadas = $this->defineRodadas($numTurnos, $numEquipes, $rodadas);
        $this->rodadaAtual = $this->defineRodadaAtual($rodadaAtual);
        $this->id = $id;
        $this->ativado = ($ativado ?? false);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    private function defineRodadas(int $turnos, int $equipes, ?int $rodadas): int
    {
        return ($rodadas ?? (($equipes-1) * $turnos));
    }

    private function defineRodadaAtual(?int $rodadaAtual): ?int
    {
        return ($rodadaAtual ?? 1);
    }

    public static function fromArray(
        array $campeonatoData, 
        string $nome = 'nome', 
        string $regiao = 'regiao', 
        string $numFases = 'num_fases', 
        string $numEquipes = 'num_equipes', 
        string $numTurnos = 'num_turnos', 
        string $temporada = 'temporada', 
        string $rodadas = 'rodadas', 
        string $rodadaAtual = 'rodada_atual', 
        ?string $id = 'id',
        ?string $ativado = 'ativado',
    ): Campeonato
    {
        return new Campeonato(
            $campeonatoData[$nome], 
            $campeonatoData[$regiao], 
            $campeonatoData[$numFases], 
            $campeonatoData[$numEquipes], 
            $campeonatoData[$numTurnos], 
            $campeonatoData[$temporada], 
            $campeonatoData[$rodadas],
            $campeonatoData[$rodadaAtual],
            id: $campeonatoData[$id],
            ativado: $campeonatoData[$ativado],
        );
    }

}
