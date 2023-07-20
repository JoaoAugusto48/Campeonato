<?php 

declare(strict_types=1);

namespace App\Http\DTO;

class PaisFormDTO 
{
    public readonly ?int $id;
    public readonly string $nome;
    public readonly string $sigla;

    /**
     * @param array|object|null $requestParsedBody
     */
    public function __construct(array $requestParsedBody, ?int $id = null) {

        $this->nome = $requestParsedBody['nome'];
        $this->sigla = $requestParsedBody['sigla'];
        $this->id = $id;
    }

}