<?php

namespace App\Http\Entity;

class Campeonato{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $regiao;
    public readonly int $numFases;
    public readonly int $numEquipes;
    public readonly ?int $rodadas;
    public readonly int $numTurnos;

    public function __construct(string $nome, string $regiao, int $numFases, int $numEquipes, int $numTurnos, ?int $rodadas = null, ?int $id = null) 
    {
        $this->nome = $nome;
        $this->regiao = $regiao;
        $this->numFases = $numFases;
        $this->numEquipes = $numEquipes;
        $this->numTurnos = $numTurnos;
        $this->rodadas = is_null($rodadas) ? $this->defineRodadas($numTurnos, $numEquipes) : $rodadas;
        $this->id = $id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    private function defineRodadas(int $turnos, int $equipes): int
    {
        return ($equipes - 1) * $turnos;
    }


    public static function fromArray(
        array $campeonatoData, 
        string $nome = 'nome', 
        string $regiao = 'regiao', 
        string $numFases = 'num_fases', 
        string $numEquipes = 'num_equipes', 
        string $numTurnos = 'num_turnos', 
        string $rodadas = 'rodadas', 
        ?string $id = 'id'
    ): Campeonato
    {
        return new Campeonato(
                $campeonatoData[$nome], 
                $campeonatoData[$regiao], 
                $campeonatoData[$numFases], 
                $campeonatoData[$numEquipes], 
                $campeonatoData[$numTurnos], 
                $campeonatoData[$rodadas],
                $campeonatoData[$id]
            );
    }

}
