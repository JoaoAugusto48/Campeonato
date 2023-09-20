<?php

namespace App\Http\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Pais
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id;
    #[ORM\Column(length: 25)]
    private string $nome;
    #[ORM\Column(length: 3)]
    private string $sigla;
    #[ORM\Column]
    private bool $status;

    public function __construct(
        string $nome = '', 
        string $sigla = '', 
        ?int $id = null
    ) {
        $this->nome = $nome;
        $this->sigla = $this->configureSigla($sigla);
        $this->id = $id;
    }

    private function configureSigla(string $sigla): string
    {
        return strtoupper($sigla); 
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

   public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome($nome): void
    {
        $this->nome = $nome;
    }

    public function getSigla(): string
    {
        return $this->sigla;
    }

    public function setSigla($sigla): void
    {
        $this->sigla = $sigla;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }
}
