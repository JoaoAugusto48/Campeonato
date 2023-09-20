<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Pais;

class PaisDTO 
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;
    public readonly bool $status;

    /**
     * @param array|object|null $requestParsedBody
     */
    public function __construct(Pais $pais) 
    {
        $this->id = $pais->getId();
        $this->nome = $pais->getNome();
        $this->sigla = $pais->getSigla();
        $this->status = $pais->getStatus();
    }

    public function __toString(): string 
    {
        return "{$this->sigla} - {$this->nome}";
    }

    /**
     * @param Pais[] $paisList
     * @return PaisDTO[]
     */
    public static function paisDTOList(array $paisList): array
    {
        $paises = [];
        foreach ($paisList as $pais) {
            $paises[] = new PaisDTO($pais);
        }

        return $paises;
    }

    public static function getPaisDTO(Pais $pais): PaisDTO
    {
        return new PaisDTO($pais);
    }

}