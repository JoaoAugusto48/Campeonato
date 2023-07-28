<?php 

declare(strict_types=1);

namespace App\Http\DTO;

use App\Http\Entity\Pais;

class PaisToViewDTO 
{

    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;

    public function __construct(Pais $pais) {
        
        $this->nome = $pais->nome;
        $this->sigla = $pais->sigla;
        $this->id = $pais->id;
    }

    /** 
     * @param Pais[] $paisList
     * @return PaisToViewDTO[]
     */
    public static function fromList(array $paisList): array
    {
        $paisViewList = [];
        foreach($paisList as $pais) {
            $paisViewList[] = new PaisToViewDTO($pais);
        }

        return $paisViewList;
    }

}