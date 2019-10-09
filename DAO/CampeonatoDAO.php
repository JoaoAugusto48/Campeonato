<?php
    require_once('../Sql.php');
    require_once('../model/Campeonato.php');

    class CampeonatoDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        //Listas
        public function listarId(int $id){
            $resultado = $this->sql->query('SELECT * FROM campeonato WHERE id=:id',[':id'],[$id])[0];
            $campeonato = new Campeonato();
            $campeonato->setId($id);
            $campeonato->setNome($resultado->nome);
            $campeonato->setTurno($resultado->turno);
            $campeonato->setNEquipe($resultado->nequipe);
            return $campeonato;
        }

        public function listarCampeonato():array{
            $resultados = $this->sql->query('SELECT * FROM campeonato',[],[]);
            $retorno = [];
            foreach($resultados as $resultado){
                $campeonato = new Campeonato();
                $campeonato->setId($resultado->id);
                $campeonato->setNome($resultado->nome);
                $campeonato->setNEquipe($resultado->nequipe);
                $campeonato->setTurno($resultado->turno);
                array_push($retorno,$campeonato);
            }
            return $retorno;
        }

        //Inserir
        public function inserirCampeonato(string $nome, int $nequipe, bool $turno):int{
            $inserir = $this->sql->query('INSERT INTO campeonato (nome, nequipe, turno) VALUES (:nome,:nequipe,:turno)',[':nome',':nequipe',':turno'],[$nome,$nequipe,$turno]);
            $ultimoId = $this->sql->ultimoIdInserido();
            $campeonato = new Campeonato();
            $campeonato->setNome($nome);
            $campeonato->setNEquipe($nequipe);
            $campeonato->setTurno($turno);
            return $ultimoId;
        } 

        //Modificar
        

        //Deletar (logicamente)

        //Deletar
    }

?>