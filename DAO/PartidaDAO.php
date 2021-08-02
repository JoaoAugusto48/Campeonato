<?php
    require_once(__ROOT__.'/Sql.php');
    require_once(__ROOT__.'/model/Partida.php');

    class PartidaDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        //Listas
        public function listarPartidas(int $idcampeonato,int $rodada):array{
            $resultados = $this->sql->query('SELECT * FROM partida WHERE rodada=:rodada AND idcampeonato=:idcampeonato ORDER BY id ASC',[':rodada',':idcampeonato'],[$rodada,$idcampeonato]);
            $retorno = [];
            foreach($resultados as $resultado){
                $partida = new Partida();
                $partida->setId($resultado->id);
                $partida->setIdCampeonato($resultado->idcampeonato);
                $partida->setTimeCasa($resultado->timecasa);
                $partida->setTimeVisitante($resultado->timevisitante);
                $partida->setNGolCasa($resultado->ngolcasa);
                $partida->setNGolVisitante($resultado->ngolvisitante);
                $partida->setRodada($resultado->rodada);
                $partida->setStatus($resultado->status);
                array_push($retorno,$partida);
            }
            return $retorno;
        }

        //Inserir
        public function criarPartida(int $idcampeonato,int $rodada ,int $timecasa,int $timevisitante):void{
            $status = false;
            $ngolcasa = 0;
            $ngolvisitante = 0;
            $resultado = $this->sql->query('INSERT INTO partida (idcampeonato,timecasa,timevisitante,ngolcasa,ngolvisitante,rodada,status) 
                            VALUES (:idcampeonato,:timecasa,:timevisitante,:ngolcasa,:ngolvisitante,:rodada,:status)',
                            [':idcampeonato',':timecasa',':timevisitante',':ngolcasa',':ngolvisitante',':rodada',':status'],
                            [$idcampeonato,$timecasa,$timevisitante,$ngolcasa,$ngolvisitante,$rodada,$status]);
            $partida = new Partida();
            $partida->setIdCampeonato($idcampeonato);
            $partida->setTimeCasa($timecasa);
            $partida->setTimeVisitante($timevisitante);
            $partida->setNGolCasa($ngolcasa);
            $partida->setNGolVisitante($ngolvisitante);
            $partida->setRodada($rodada);
            $partida->setStatus($status);
        }

        //Modificar
        public function resultadoPartida(int $idcampeonato,int $id,int $ngolcasa,int $ngolvisitante):void{
            $status = true;
            $resultado = $this->sql->query('UPDATE partida SET ngolcasa=:ngolcasa, ngolvisitante=:ngolvisitante, status=:status
                            WHERE idcampeonato=:idcampeonato AND id=:id',
                            [':ngolcasa',':ngolvisitante',':status',':idcampeonato',':id'],
                            [$ngolcasa,$ngolvisitante,$status,$idcampeonato,$id]);
            $partida = new Partida();
            $partida->setId($id);
            $partida->setIdCampeonato($idcampeonato);
            $partida->setNGolCasa($ngolcasa);
            $partida->setNGolVisitante($ngolvisitante);
            $partida->setStatus($status);
        }

        // Select de partida para recuperar resultado para a atualizar a estatistica
        public function partidaAnterior(int $idpartida):object{
            $resultado = $this->sql->query('SELECT * FROM partida WHERE id=:idpartida',[':idpartida'],[$idpartida])[0];
            $partida = new Partida();
            $partida->setIdCampeonato($resultado->idcampeonato);
            $partida->setTimeCasa($resultado->timecasa);
            $partida->setTimeVisitante($resultado->timevisitante);
            $partida->setNGolCasa($resultado->ngolcasa);
            $partida->setNGolVisitante($resultado->ngolvisitante);
            return $partida;
        }

        //Deletar (logicamente)

        //Deletar
    }

?>