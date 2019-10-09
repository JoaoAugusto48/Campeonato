<?php
    
    class Partida{
        private $id;
        private $idcampeonato;
        private $timecasa;
        private $timevisitante;
        private $ngolcasa;
        private $ngolvisitante;
        private $rodada;
        private $status;

        //GETs
        public function getId():int{
            return $this->id;
        }

        public function getIdCampeonato():int{
            return $this->idcampeonato;
        }

        public function getTimeCasa():int{
            return $this->timecasa;
        }

        public function getTimeVisitante():int{
            return $this->timevisitante;
        }

        public function getNGolCasa():int{
            return $this->ngolcasa;
        }

        public function getNGolVisitante():int{
            return $this->ngolvisitante;
        }
        
        public function getRodada():int{
            return $this->rodada;
        }

        public function getStatus():bool{
            return $this->status;
        }

        //SETs
        public function setId(int $id):void{
            $this->id = $id;
        }

        public function setIdCampeonato(int $idcampeonato):void{
            $this->idcampeonato = $idcampeonato;
        }

        public function setTimeCasa(int $timecasa):void{
            $this->timecasa = $timecasa;
        }

        public function setTimeVisitante(int $timevisitante):void{
            $this->timevisitante = $timevisitante;
        }

        public function setNGolCasa(int $ngolcasa):void{
            $this->ngolcasa = $ngolcasa;
        }

        public function setNGolVisitante(int $ngolvisitante):void{
            $this->ngolvisitante = $ngolvisitante;
        }

        public function setRodada(int $rodada):void{
            $this->rodada = $rodada;
        }

        public function setStatus(bool $status):void{
            $this->status = $status;
        }
    }
?>