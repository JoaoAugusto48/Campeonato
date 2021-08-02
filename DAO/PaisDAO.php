<?php
    require_once(__ROOT__.'/Sql.php');
    require_once(__ROOT__.'/model/Pais.php');
    
    class PaisDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }
        
        //Listas
        public function listarPorNome():array{
            $resultados = $this->sql->query('SELECT * FROM pais WHERE status=1 ORDER BY nome',[],[]);
            $retorno = [];
            foreach($resultados as $resultado){
                $pais = new Pais();
                $pais->setId($resultado->id);
                $pais->setNome($resultado->nome);
                array_push($retorno,$pais);
            }
            return $retorno;
        }
        
        public function listarPorId():array{
            $resultados = $this->sql->query('SELECT * FROM pais WHERE status=1 ORDER BY id',[],[]);
            $retorno = [];
            foreach($resultados as $resultado){
                $id = new Pais();
                $id->setId($resultado->id);
                $id->setNome($resultado->nome);
                array_push($retorno,$id);
            }
            return $retorno;
        }

        //Inserir
        public function inserirPais(string $nome):void{
            $status = true;
            $inserir = $this->sql->query('INSERT INTO pais (nome, status) VALUE (:nome, :status)',[':nome',':status'],[$nome,$status]);
            $pais = new Pais();
            $pais->setNome($nome);
            $pais->setStatus($status);
        }

        //Modificar
        public function selecionarPais(int $id):Pais{
            $editar = $this->sql->query('SELECT * FROM pais WHERE id=:id',[':id'],[$id])[0];
            $pais = new Pais();
            $pais->setId($editar->id);
            $pais->setNome($editar->nome);
            return $pais;
        }

        public function edtPais(int $id, string $nome):void{
            $editar = $this->sql->query('UPDATE pais SET nome=:nome WHERE id=:id',[':nome',':id'],[$nome,$id]);
            $pais = new Pais();
            $pais->setNome($nome);
        }

        //Remover

        //Remover (logicamente)
        public function remLogPais(int $id):void{
            $status = false;
            $remlogica = $this->sql->query('UPDATE pais SET status=:status WHERE id=:id',[':status',':id'],[$status,$id]);
            $pais = new Pais();
            $pais->setStatus($status);
        }
    }
?>