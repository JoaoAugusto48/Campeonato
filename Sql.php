<?php

class Sql{

    private $conexao;

    public function __construct(){
        try{
            $this->conexao= new \PDO('mysql:host=127.0.0.1:3306;dbname=campeonato;charset=utf8', 'root', '');
        }catch(PDOException $e){
            var_dump($e);
            exit();
        }
    }

    public function query(string $query, array $parametros, array $binds): array{
        $consulta = $this->conexao->prepare($query);
        for ($i = 0; $i < count($parametros); $i++) {
            $consulta->bindParam($parametros[$i], $binds[$i]);
        }
        try{
            $consulta->execute();
            $resposta = $consulta->fetchAll(\PDO::FETCH_OBJ);
        }
        catch(PDOException $e){
            var_dump($e);
            exit();
        }
        return $resposta;
    }

    public function ultimoIdInserido():int{
        return $this->conexao->lastInsertId();
    }
}