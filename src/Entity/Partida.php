<?php

namespace App\Http\Entity;
    
class Partida
{
    public readonly ?int $id;
    public readonly int $campeonatoId;
    public readonly int $timeCasaId;
    public readonly int $timeVisitanteId;
    public readonly int $numGolCasa;
    public readonly int $numGolVisitante;
    public readonly int $rodada;
    public readonly ?bool $status;
    public readonly ?Equipe $timeCasa;
    public readonly ?Equipe $timeVisitante;
    
    public function __construct(
        int $campeonatoId,
        int $timeCasaId,
        int $timeVisitanteId,
        int $rodada,
        ?int $numGolCasa = null,
        ?int $numGolVisitante = null,
        ?int $id = null,
        ?bool $status = true,
        ?Equipe $timeCasa = null,
        ?Equipe $timeVisitante = null,
    ) 
    {
        $this->campeonatoId = $campeonatoId;
        $this->timeCasaId = $timeCasaId;
        $this->timeVisitanteId = $timeVisitanteId;
        $this->rodada = $rodada;
        $this->numGolCasa = $numGolCasa;
        $this->numGolVisitante = $numGolVisitante;
        $this->status = $status;
        $this->id = $id;
        
        $this->timeCasa = $timeCasa;
        $this->timeVisitante = $timeVisitante;
    } 

    public static function fromArray(
       array $partidaData,
       string $campeonatoId = 'campeonatos_id', 
       string $timeCasaId = 'time_casa', 
       string $timeVisitanteId = 'time_visitante', 
       string $rodada = 'rodada', 
       ?string $numGolCasa = 'num_gols_casa', 
       ?string $numGolVisitante = 'num_gols_visitante', 
       ?string $id = 'id',
       ?string $status = 'status', 
       ?string $timeCasa = 'equipeCasa', 
       ?string $timeVisitante = 'equipeVisitante', 
    ): Partida
    {
        if(!isset($partidaData[$numGolCasa])) {
            $partidaData[$numGolCasa] = null;
        } 
        if(!isset($partidaData[$numGolVisitante])) {
            $partidaData[$numGolVisitante] = null;
        } 
        if(!isset($partidaData[$timeCasa])) {
            $partidaData[$timeCasa] = null;
        } 
        if(!isset($partidaData[$timeVisitante])) {
            $partidaData[$timeVisitante] = null;
        } 
        if(!isset($partidaData[$status])) {
            $partidaData[$status] = null;
        } 

        return new Partida(
            $partidaData[$campeonatoId],
            $partidaData[$timeCasaId],
            $partidaData[$timeVisitanteId],
            $partidaData[$rodada],
            $partidaData[$numGolCasa],
            $partidaData[$numGolVisitante],
            $partidaData[$id],
            $partidaData[$status],
            $partidaData[$timeCasa],
            $partidaData[$timeVisitante],
        );
    }
    
}
