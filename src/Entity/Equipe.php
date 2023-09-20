<?php

namespace App\Http\Entity;

use App\Http\Entity\Pais;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'equipes')]
class Equipe
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id;
    #[ORM\Column]
    private string $nome;
    #[ORM\Column]
    private string $sigla;
    #[ORM\Column('pais_id')]
    private int $paisId;
    // private bool $status;
    #[ORM\ManyToOne(targetEntity: Pais::class, fetch: 'EAGER')]
    #[ORM\JoinColumn('pais_id', referencedColumnName: 'id')]
    private ?Pais $pais = null;
    
    #[ORM\ManyToMany(Campeonato::class, 'equipes')]
    #[ORM\JoinTable(name: 'estatisticas')]
    private Collection $campeonatos;
    
    #[ORM\OneToMany(
        mappedBy: 'equipe',
        targetEntity: Estatistica::class,
    )]
    private Collection $estatisticas;
    
    #[ORM\OneToMany(
        targetEntity: Partida::class,
        mappedBy: 'equipe',
    )]
    public Collection $partidas;

    public function __construct(
        string $nome,
        string $sigla,
        int $paisId,
        ?int $id = null,
        ?Pais $pais = null,
    ) {
        $this->nome = $nome;
        $this->sigla = $this->configureSigla($sigla);
        $this->paisId = $paisId;
        $this->id = $id;

        $this->pais = $pais;

        $this->campeonatos = new ArrayCollection();
        $this->partidas = new ArrayCollection();
    }

    public function enrollInCampeonato(Campeonato $campeonato): void
    {
        if ($this->campeonatos->contains($campeonato)) {
            return;
        }

        $this->campeonatos->add($campeonato);
        $campeonato->addEquipe($this);
    }

    public function addEstatistica(Estatistica $estatistica): void
    {
        $this->estatisticas->add($estatistica);
        $estatistica->setEquipe($this);
    }

    /** @return Collection<Campeonato> */
    public function campeonatos(): Collection
    {
        return $this->campeonatos;
    }

    /** @return Collection<Partida> */
    public function partidas(): Collection
    {
        return $this->partidas;
    }

    public function addPartida(Partida $partida): void
    {
        $this->partidas->add($partida);
    }

    private function configureSigla(string $sigla): string
    {
        return strtoupper($sigla);
    }

    public function setPais(Pais $pais): void
    {
        $this->pais = $pais;
    }

    public function getPais(): Pais
    {
        return $this->pais;
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

    public function getSigla(): string
    {
        return $this->sigla;
    }

    public function setSigla(string $sigla): void
    {
        $this->sigla = $sigla;
    }

    public function getPaisId(): int
    {
        return $this->paisId;
    }

    public function setPaisId(int $paisId): void
    {
        $this->paisId = $paisId;
    }
}
