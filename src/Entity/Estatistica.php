<?php

namespace App\Http\Entity;

use App\Http\Entity\Campeonato;
use App\Http\Entity\Equipe;
use App\Http\Enum\PontosEnum;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('estatisticas')]
class Estatistica
{
    #[Id, GeneratedValue, Column]
    public int $id;
    #[Column]
    public int $vitorias;
    #[Column]
    public int $empates;
    #[Column]
    public int $derrotas;
    #[Column('gols_pro')]
    public int $golsPro;
    #[Column('gols_contra')]
    public int $golsContra;
    public int $pontos=0; // criado apenas para mostrar os pontos
    public int $saldoGols=0; // criado apenas para mostrar o Saldo
    public int $jogos=0; // criado apenas para mostrar a qtde de Jogos

    #[Column('equipe_id')]
    public int $equipeId;
    #[Column('campeonato_id')]
    public int $campeonatoId;

    #[ManyToOne(targetEntity: Campeonato::class, inversedBy: 'estatisticas')]
    public Campeonato $campeonato;
    #[ManyToOne(Equipe::class, inversedBy: 'estatisticas')]
    public ?Equipe $equipe;
    
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

    public function calcularDetalhes(): void 
    {
        $this->jogos = $this->defineJogos($this->vitorias, $this->empates, $this->derrotas);
        $this->pontos = $this->definePontos($this->vitorias, $this->empates, $this->derrotas);
        $this->saldoGols = $this->defineSaldo($this->golsPro, $this->golsContra);
    }

    public static function getInstance(Estatistica $estatistica): Estatistica
    {
        return new Estatistica(
            $estatistica->vitorias,
            $estatistica->empates,
            $estatistica->derrotas,
            $estatistica->golsPro,
            $estatistica->golsContra,
            $estatistica->campeonatoId,
            $estatistica->equipeId,
            $estatistica->id,
        );
    }

    public function setCampeonato(Campeonato $campeonato): void 
    {
        $this->campeonato = $campeonato;
    }

    public function setEquipe(Equipe $equipe): void 
    {
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

}
