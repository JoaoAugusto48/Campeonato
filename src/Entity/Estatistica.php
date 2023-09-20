<?php

namespace App\Http\Entity;

use App\Http\Entity\Campeonato;
use App\Http\Entity\Equipe;
use App\Http\Enum\PontosEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('estatisticas')]
class Estatistica
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private int $id;
    #[ORM\Column]
    private int $vitorias;
    #[ORM\Column]
    private int $empates;
    #[ORM\Column]
    private int $derrotas;
    #[ORM\Column('gols_pro')]
    private int $golsPro;
    #[ORM\Column('gols_contra')]
    private int $golsContra;
    private ?int $pontos = null; // criado apenas para mostrar os pontos
    private ?int $saldoGols = null; // criado apenas para mostrar o Saldo
    private ?int $jogos = null; // criado apenas para mostrar a qtde de Jogos

    #[ORM\Column('equipe_id')]
    private int $equipeId;
    #[ORM\Column('campeonato_id')]
    private int $campeonatoId;

    #[ORM\ManyToOne(targetEntity: Campeonato::class, inversedBy: 'estatisticas')]
    private Campeonato $campeonato;
    #[ORM\ManyToOne(Equipe::class, inversedBy: 'estatisticas')]
    private ?Equipe $equipe;

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
    ) {
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

    public function getPontos(): ?int
    {
        return $this->pontos;
    }

    public function getSaldoGols(): ?int
    {
        return $this->saldoGols;
    }

    public function getJogos(): ?int
    {
        return $this->jogos;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getVitorias(): int
    {
        return $this->vitorias;
    }

    public function setVitorias(int $vitorias): void
    {
        $this->vitorias = $vitorias;
    }

    public function getEmpates(): int
    {
        return $this->empates;
    }

    public function setEmpates(int $empates): void
    {
        $this->empates = $empates;
    }

    public function getDerrotas(): int
    {
        return $this->derrotas;
    }

    public function setDerrotas(int $derrotas): void
    {
        $this->derrotas = $derrotas;
    }

    public function getGolsPro(): int
    {
        return $this->golsPro;
    }

    public function setGolsPro(int $golsPro): void
    {
        $this->golsPro = $golsPro;
    }

    public function getGolsContra(): int
    {
        return $this->golsContra;
    }

    public function setGolsContra(int $golsContra): void
    {
        $this->golsContra = $golsContra;
    }

    public function getEquipeId(): int
    {
        return $this->equipeId;
    }

    public function setEquipeId(int $equipeId): void
    {
        $this->equipeId = $equipeId;
    }

    public function getCampeonatoId(): int
    {
        return $this->campeonatoId;
    }

    public function setCampeonatoId(int $campeonatoId): void
    {
        $this->campeonatoId = $campeonatoId;
    }

    public function getCampeonato(): Campeonato
    {
        return $this->campeonato;
    }

    public function setCampeonato(Campeonato $campeonato): void
    {
        $this->campeonato = $campeonato;
    }

    public function getEquipe(): Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(Equipe $equipe): void
    {
        $this->equipe = $equipe;
    }
}
