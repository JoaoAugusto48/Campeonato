<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Campeonato;

class RodadaDTO
{
    public readonly int $partidaId;
    public readonly int $rodada;
    /** @var \App\Http\DTO\PartidaDTO[] $partidas*/
    public readonly array $partidas;

    /** @var \App\Http\Entity\Partida[] $partidaList
     *  @return \App\Http\DTO\RodadaDTO[]
     */
    public static function fillPartidas(Campeonato $campeonato, array $partidaList): array
    {
        $rodadaList = [];

        for($i=0; $i < $campeonato->rodadas; $i++) {
            $rodada = new RodadaDTO();
            
            $rodada->rodada = $i+1;
            $partidas = [];
            foreach($partidaList as $partida) {
                if($rodada->rodada == $partida->rodada) {
                    $timeCasa = new EquipePartidaDTO($partida->timeCasa->nome,$partida->timeCasa->sigla,$partida->numGolCasa,$partida->timeCasa->id);
                    $timeVisitante = new EquipePartidaDTO($partida->timeVisitante->nome,$partida->timeVisitante->sigla,$partida->numGolVisitante,$partida->timeVisitante->id);
                    
                    $partidas[] = new PartidaDTO($timeCasa, $timeVisitante, $partida->id);
                }
            }
            $rodada->partidas = $partidas;
            $rodadaList[] = $rodada;
        }

        return $rodadaList;
    }

    /** @var \App\Http\Entity\Partida[] $partidaList */
    public static function fillPartidaMap(array $partidaList): array
    {
        $partidaMap = [];
  
        foreach($partidaList as $partida) {            

            $golsCasa = $partida->numGolCasa;
            $golsVisitante = $partida->numGolVisitante;
            if(!$partida->status){
                $golsCasa = null;
                $golsVisitante = null;    
            } 

            $timeCasa = new EquipePartidaDTO($partida->timeCasa->nome,$partida->timeCasa->sigla,$golsCasa,$partida->timeCasa->id);
            $timeVisitante = new EquipePartidaDTO($partida->timeVisitante->nome,$partida->timeVisitante->sigla,$golsVisitante,$partida->timeVisitante->id);
            
            $partidaMap[$partida->rodada][] = new PartidaDTO($timeCasa, $timeVisitante, $partida->id);
        }
        return $partidaMap;
    }
}