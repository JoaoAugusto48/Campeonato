<<<<<<< HEAD
<?php
    require_once('Pais.php');
    
    class Equipe{
        private $id;
        private $nome;
        private $sigla;
        private $idPais;
        
        private $pais;
        
        public function __construct(){
            $this->pais = new Pais();
        }

        // GET
        public function getId():int{
            return $this->id;
        }

        public function getNome():string{
            return $this->nome;
        }

        public function getSigla():string{
            return $this->sigla;
        }

        public function getIdPais():int{
            return $this->idPais;
        }
        
        public function getPais():Pais{
            return $this->pais;
        }
        // SET
        public function setId(int $id): void{
            $this->id = $id;
        }

        public function setNome(string $nome): void{
            $this->nome = $nome;
        }

        public function setSigla(string $sigla): void{
            $this->sigla = $sigla;
        }

        public function setIdPais(int $idPais): void{
            $this->idPais = $idPais;
        }

        //verificar essa função
        public function setPais(int $pais): void{
            $this->pais = $pais;
        }
    }

=======
<?php
    require_once('Pais.php');
    
    class Equipe{
        private $id;
        private $nome;
        private $sigla;
        private $idPais;
        
        private $pais;
        
        public function __construct(){
            $this->pais = new Pais();
        }

        // GET
        public function getId():int{
            return $this->id;
        }

        public function getNome():string{
            return $this->nome;
        }

        public function getSigla():string{
            return $this->sigla;
        }

        public function getIdPais():int{
            return $this->idPais;
        }
        
        public function getPais():Pais{
            return $this->pais;
        }
        // SET
        public function setId(int $id): void{
            $this->id = $id;
        }

        public function setNome(string $nome): void{
            $this->nome = $nome;
        }

        public function setSigla(string $sigla): void{
            $this->sigla = $sigla;
        }

        public function setIdPais(int $idPais): void{
            $this->idPais = $idPais;
        }

        //verificar essa função
        public function setPais(int $pais): void{
            $this->pais = $pais;
        }
    }

>>>>>>> 04f6116eb9f2ad714e84a935ae8d64e67a8b762a
?>