<?php

namespace App\Http\Entity;

class Pais{
    public readonly int $id;
    public readonly string $nome;
    public readonly string $sigla;

    public function __construct(
        string $nome,
        string $sigla
    ) {
        $this->validaNome($nome);
        $this->validaSigla($sigla);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @throws \PDOException
     */
    private function validaSigla(string $sigla): void 
    {
        // $size = 3;
        // if(strlen($sigla) > $size) {
        //     throw new \PDOException("Sigla só pode ter até $size caracteres.");
        // }

        $this->sigla = $sigla;
    }

    private function validaNome(string $nome): void
    {
        // if(is_null($nome) || strlen($nome) === 0){
        //     throw new \RangeException('O nome não pode ser nulo.');
        // }

        $this->nome = $nome;
    }

    public function __toString(): string 
    {
        return "{$this->sigla} - {$this->nome}";
    }

    public function paisShowSelect(): string
    {
        return "{$this->sigla} - {$this->nome}";
    }

    public function paisEncode(): string 
    {
        return htmlspecialchars(json_encode($this));
    }

    public static function paisDecode(string $stringPais): Pais
    {
        $paisData = json_decode($stringPais, true);

        $pais = new Pais($paisData['nome'], $paisData['sigla']);
        $pais->setId($paisData['id']);

        return $pais;
    }

}
