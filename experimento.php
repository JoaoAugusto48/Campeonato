<?php

class Pessoa 
{

    private ?string $nome;
    private ?string $apelido;

    public function __construct(string $nome = null, string $apelido = null)
    {
        $this->nome = $nome;
        $this->apelido = $apelido;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $value)
    {
        $this->$atributo = $value;
    }

}

$pessoa = new Pessoa(apelido: 'João');
// $pessoa->apelido = 'Bonifacio';
// $pessoa->nome = 'João';

var_dump($pessoa);
