<?php

namespace App\Http\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'campeonatos')]
class Campeonato
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id;
    #[ORM\Column]
    private string $nome;
    #[ORM\Column]
    private string $regiao;
    #[ORM\Column('num_fases')]
    private int $numFases;
    #[ORM\Column('num_equipes')]
    private int $numEquipes;
    #[ORM\Column]
    private string $temporada;
    #[ORM\Column]
    private ?int $rodadas;
    #[ORM\Column('rodada_atual')]
    private ?int $rodadaAtual;
    #[ORM\Column('num_turnos')]
    private int $numTurnos;
    #[ORM\Column]
    private ?bool $ativado;

    #[ORM\ManyToMany(Equipe::class, mappedBy: 'campeonatos')]
    private Collection $equipes;

    #[ORM\OneToMany(
        mappedBy: 'campeonato',
        targetEntity: Estatistica::class
    )]
    private Collection $estatisticas;

    public function __construct(
        string $nome = '',
        string $regiao = '', 
        int $numFases = 0, 
        int $numEquipes = 0, 
        int $numTurnos = 0, 
        string $temporada = '', 
        ?int $rodadas = null, 
        ?int $rodadaAtual = 1, 
        ?int $id = null, 
        ?bool $ativado = null)
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

        $this->equipes = new ArrayCollection();
    }

    public function equipes(): Collection
    {
        return $this->equipes;
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
        return ($rodadas ?? (($equipes - 1) * $turnos));
    }

    private function defineRodadaAtual(?int $rodadaAtual): ?int
    {
        return ($rodadaAtual ?? 1);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

   public function setId(?int $id): void
    {
        $this->id = $id;
    }

   public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getRegiao(): string
    {
        return $this->regiao;
    }

    public function setRegiao(string $regiao): void
    {
        $this->regiao = $regiao;
    }

    public function getNumFases(): int
    {
        return $this->numFases;
    }

    public function setNumFases(int $numFases): void
    {
        $this->numFases = $numFases;
    }

    public function getNumEquipes(): int
    {
        return $this->numEquipes;
    }

    public function setNumEquipes(int $numEquipes): void
    {
        $this->numEquipes = $numEquipes;
    }

    public function getTemporada(): string
    {
        return $this->temporada;
    }

    public function setTemporada(string $temporada): void
    {
        $this->temporada = $temporada;
    }

    public function getRodadas(): ?int
    {
        return $this->rodadas;
    }

    public function setRodadas(?int $rodadas): void
    {
        $this->rodadas = $rodadas;
    }

    public function getRodadaAtual(): ?int
    {
        return $this->rodadaAtual;
    }

    public function setRodadaAtual(?int $rodadaAtual): void
    {
        $this->rodadaAtual = $rodadaAtual;
    }

    public function getNumTurnos(): int
    {
        return $this->numTurnos;
    }

    public function setNumTurnos(int $numTurnos): void
    {
        $this->numTurnos = $numTurnos;
    }

    public function getAtivado(): ?bool
    {
        return $this->ativado;
    }

    public function setAtivado(?bool $ativado): void
    {
        $this->ativado = $ativado;
    }
}
