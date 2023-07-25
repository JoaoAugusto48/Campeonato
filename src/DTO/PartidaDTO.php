<?php 

declare(strict_types=1);

namespace App\Http\DTO;

class PartidaDTO
{
    public readonly ?int $partidaId;
    public readonly EquipePartidaDTO $equipeCasa;
    public readonly EquipePartidaDTO $equipeVisitante;
    public readonly ?bool $status;

    public function __construct(EquipePartidaDTO $equipeCasa, EquipePartidaDTO $equipeVisitante, ?int $partidaId = null) 
    {
        $this->equipeCasa = $equipeCasa;
        $this->equipeVisitante = $equipeVisitante;
        $this->partidaId = $partidaId;
    }

}