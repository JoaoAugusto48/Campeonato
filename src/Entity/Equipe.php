<?php

namespace App\Http\Entity;

use App\Http\Entity\Pais;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'equipes')]
class Equipe
{
    #[Id, GeneratedValue, Column]
    public ?int $id;
    #[Column]
    public string $nome;
    #[Column]
    public string $sigla;
    #[Column('pais_id')]
    public int $paisId;
    // #[Column]
    private bool $status;

    #[ManyToOne(targetEntity: Pais::class)]
    public ?Pais $pais;

    #[ManyToMany(Campeonato::class, 'equipes')]
    private Collection $campeonatos;

    #[OneToMany(
        mappedBy: 'equipe',
        targetEntity: Estatistica::class
    )]
    private Collection $estatisticas;

    #[OneToMany(
        mappedBy: 'equipe',
        targetEntity: Partida::class
    )]
    public Collection $partidas;
    
    public function __construct(
        string $nome,
        string $sigla,
        int $paisId,
        ?int $id = null,
        ?Pais $pais = null,
    ){
        $this->nome = $nome;
        $this->sigla = $this->configureSigla($sigla);
        $this->paisId = $paisId;
        $this->id = $id;
        
        $this->pais = $pais;
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

    public function addPartida(Partida $partida): void 
    {
        $this->partidas->add($partida);
    }

    public function setPais(Pais $pais): void 
    {
        $this->pais = $pais;
    }
    
    public function getStatus():int{
        return $this->status;
    }
    
    public function setStatus(int $status):void{
        $this->status = $status;
    }

    private function configureSigla(string $sigla): string
    {
        return strtoupper($sigla); 
    }

}
