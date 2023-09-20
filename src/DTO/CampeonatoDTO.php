<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Campeonato;
use Doctrine\Common\Collections\Collection;

class CampeonatoDTO 
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $regiao;
    public readonly int $numFases;
    public readonly int $numEquipes;
    public readonly string $temporada;
    public readonly ?int $rodadas;
    public readonly ?int $rodadaAtual;
    public readonly int $numTurnos;
    public readonly ?bool $ativado;
    public readonly Collection $equipes;

    public function __construct(Campeonato $campeonato) 
    {
        $this->id = $campeonato->getId();
        $this->nome = $campeonato->getNome();
        $this->regiao = $campeonato->getRegiao();
        $this->numFases = $campeonato->getNumFases();
        $this->numEquipes = $campeonato->getNumEquipes();
        $this->temporada = $campeonato->getTemporada();
        $this->rodadas = $campeonato->getRodadas();
        $this->rodadaAtual = $campeonato->getRodadaAtual();
        $this->numTurnos = $campeonato->getNumTurnos();
        $this->ativado = $campeonato->getAtivado();

        $this->equipes = $campeonato->equipes();
    }
    
    /**
     * @param Campeonato[] $equipeList
     * @return CampeonatoDTO[]
     */
    public static function campeonatoDTOList(array $campeonatoList): array
    {
        $campeonatos = [];
        foreach ($campeonatoList as $campeonato) {
            $campeonatos[] = new CampeonatoDTO($campeonato);
        }
        
        return $campeonatos;
    }

    public static function getCampeonatoDTO(Campeonato $campeonato): CampeonatoDTO
    {
        return new CampeonatoDTO($campeonato);
    }
}