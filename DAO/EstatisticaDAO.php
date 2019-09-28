<?php
    require_once('../Sql.php');
    require_once('../model/Estatistica.php');

    class EstatisticaDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        //Listas
        public function listarPorCampeonato(int $id):array{
            $resultados = $this->sql->query('SELECT * FROM estatistica WHERE id=:id',[':id'],[$id]);
            var_dump($resultados);
            $retorno = [];
            foreach($resultados as $resultado){
                $estatistica = new Estatistica();
                $estatistica->setId($resultado->id);
                $estatistica->setVitoria($resultado->vitoria);
                $estatistica->setEmpate($resultado->empate);
                $estatistica->setDerrota($resultado->derrota);
                $estatistica->setGolPro($resultado->golpro);
                $estatistica->setGolContra($resultado->golcontra);
                $estatistica->setIdEquipe($resultado->idequipe);
                $estatistica->setIdCampeonato($resultado->idcampeonato);

                array_push($retorno,$estatistica);

                //$estatistica->getCampeonato()->setNome($resultado->campeonato);

            }
            return $retorno;
        }

        //Inserir
        public function inserirEstatistica(int $idequipe,int $idcampeonato):void{
            $vitoria=0;
            $empate=0;
            $derrota=0;
            $golpro=0;
            $golcontra=0;

            $resultado = $this->sql->query('INSERT INTO estatistica (vitoria,empate,derrota,golpro,golcontra,idequipe,idcampeonato)
                VALUES (:vitoria,:empate,:derrota,:golpro,:golcontra,:idequipe,:idcampeonato)',
                [':vitoria',':empate',':derrota',':golpro',':golcontra',':idequipe',':idcampeonato'],
                [$vitoria,$empate,$derrota,$golpro,$golcontra,$idequipe,$idcampeonato]);
            $estatistica = new Estatistica();
            $estatistica->setVitoria($vitoria);
            $estatistica->setEmpate($empate);
            $estatistica->setDerrota($derrota);
            $estatistica->setGolPro($golpro);
            $estatistica->setGolContra($golcontra);
            $estatistica->setIdEquipe($idequipe);
            $estatistica->setIdCampeonato($idcampeonato);
            
        }

        //Modificar

        //Deletar (logicamente)

        //Deletar
    }
?>