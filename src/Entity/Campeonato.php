<?php

namespace App\Http\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'campeonatos')]
class Campeonato
{
    #[Id, GeneratedValue, Column]
    public ?int $id;
    #[Column]
    public string $nome;
    #[Column]
    public string $regiao;
    #[Column('num_fases')]
    public int $numFases;
    #[Column('num_equipes')]
    public int $numEquipes;
    #[Column]
    public string $temporada;
    #[Column]
    public ?int $rodadas;
    #[Column('rodada_atual')]
    public ?int $rodadaAtual;
    #[Column('num_turnos')]
    public int $numTurnos;
    #[Column]
    public ?bool $ativado;

    #[ManyToMany(Equipe::class, mappedBy: 'campeonatos')]
    private Collection $equipes;

    #[OneToMany(
        mappedBy: 'campeonato', 
        targetEntity: Estatistica::class
    )]
    private Collection $estatisticas;

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

    public function equipes(): Collection
    {
        return $this->equipes();
    }

    public function addEquipe(Equipe $equipe): void 
    {
        if ($this->equipes->contains($equipe)) {
            return;
        }

        $this->equipes()->add($equipe);
        $equipe->enrollInCampeonato($this);
    }

    public function addEstatistica(Estatistica $estatistica): void
    {
        $this->estatisticas->add($estatistica);
        $estatistica->setCampeonato($this);
    }

    private function defineRodadas(int $turnos, int $equipes, ?int $rodadas): int
    {
        return ($rodadas ?? (($equipes-1) * $turnos));
    }

    private function defineRodadaAtual(?int $rodadaAtual): ?int
    {
        return ($rodadaAtual ?? 1);
    }
}
