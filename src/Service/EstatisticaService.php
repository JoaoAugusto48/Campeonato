<?php

declare(strict_types=1);

namespace App\Http\Service;

use App\Http\Repository\EstatisticaRepository;

class EstatisticaService
{
    public function __construct(
        private EstatisticaRepository $estatisticaRepository,
    ) {
    }

    /** @return \App\Http\Entity\Estatistica[]  */
    public function findByCampeonatoId(int $champId): array
    {
        return $this->estatisticaRepository->findAllByCampeonatoId($champId);
    }

}