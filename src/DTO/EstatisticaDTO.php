<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Estatistica;

class EstatisticaDTO 
{
    public readonly int $id;
    public readonly int $vitorias;
    public readonly int $empates;
    public readonly int $derrotas;
    public readonly int $golsPro;
    public readonly int $golsContra;
    public readonly int $pontos;
    public readonly int $saldoGols;
    public readonly int $jogos;
    public readonly int $equipeId;
    public readonly int $campeonatoId;
    public readonly CampeonatoDTO $campeonato;
    public readonly EquipeDTO $equipe;

    public function __construct(Estatistica $estatistica)
    {
        $this->id = $estatistica->getId();
        $this->vitorias = $estatistica->getVitorias();
        $this->empates = $estatistica->getEmpates();
        $this->derrotas = $estatistica->getDerrotas();
        $this->golsPro = $estatistica->getGolsPro();
        $this->golsContra = $estatistica->getGolsContra();
        $this->pontos = $estatistica->getPontos();
        $this->saldoGols = $estatistica->getSaldoGols();
        $this->jogos = $estatistica->getJogos();
        $this->equipeId = $estatistica->getEquipeId();
        $this->campeonatoId = $estatistica->getCampeonatoId();
        
        $this->campeonato = CampeonatoDTO::getCampeonatoDTO($estatistica->getCampeonato());
        $this->equipe = EquipeDTO::getEquipeDTO($estatistica->getEquipe());
    }

    /**
     * @param Estatistica[] $estatisticaList
     * @return EstatisticaDTO[]
     */
    public static function estatisticaDTOList(array $estatisticaList): array
    {
        $estatisticas = [];
        foreach ($estatisticaList as $estatistica) {
            $estatisticas[] = new EstatisticaDTO($estatistica);
        }

        return $estatisticas;
    }

    public static function getEstatisticaDTO(Estatistica $estatistica): EstatisticaDTO
    {
        return new EstatisticaDTO($estatistica);
    }

}