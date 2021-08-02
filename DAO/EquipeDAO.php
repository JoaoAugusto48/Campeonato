<?php
    require_once(__ROOT__.'/Sql.php');
    require_once(__ROOT__.'/model/Equipe.php');

    class EquipeDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        //Listas
        public function listarPorNome():array{
            $resultados = $this->sql->query('SELECT e.id, e.nome, e.sigla, e.idPais, p.nome as nomepais FROM equipe AS e JOIN pais AS p on e.idpais = p.id WHERE e.status=1 order by e.nome',[],[]);
            $retorno = [];
            foreach($resultados as $resultado){
                $equipe = new Equipe();
                $equipe->setId($resultado->id);
                $equipe->setNome($resultado->nome);
                $equipe->setSigla($resultado->sigla);
                $equipe->setIdPais($resultado->idPais);
                $equipe->getPais()->setNome($resultado->nomepais);
                array_push($retorno,$equipe);
            }
            return $retorno;
        }

        public function listarPorId(int $id){
            $resultados = $this->sql->query('SELECT e.id, e.nome, e.sigla, e.idPais, p.nome as nomepais FROM equipe AS e JOIN pais AS p ON e.idpais = p.id WHERE e.id=:id AND e.status=true',[':id'],[$id])[0];
            $equipe = new Equipe();
            $equipe->setId($id);
            $equipe->setNome($resultados->nome);
            $equipe->setSigla($resultados->sigla);
            $equipe->setIdPais($resultados->idPais);
            $equipe->getPais()->setNome($resultados->nomepais);
            return $equipe;
        }

        //Inserir
        public function insEquipe(string $nome, string $sigla, int $idPais):void{
            $status = true;
            $inserir = $this->sql->query('INSERT INTO equipe (nome, sigla, idpais, status) VALUES (:nome, :sigla, :idpais, :status)',[':nome', ':sigla', ':idpais',':status'],[$nome, $sigla, $idPais,$status]);
            $equipe = new Equipe();
            $equipe->setNome($nome);
            $equipe->setSigla($sigla);
            $equipe->setIdPais($idPais);
        }

        //Modificar
        public function editarEquipe(int $id, string $nome, string $sigla, string $idPais):void{
            $editar = $this->sql->query('UPDATE equipe SET nome=:nome, sigla=:sigla, idpais=:idpais WHERE id=:id',[':nome',':sigla',':idpais',':id'],[$nome,$sigla,$idPais,$id]);
            $equipe = new Equipe();
            $equipe->setNome($nome);
            $equipe->setSigla($sigla);
            $equipe->setIdPais($idPais);
        }

        //Deletar (logicamente)
        public function removerLogicamente(int $id){
            $status = false;
            $remover = $this->sql->query('UPDATE equipe SET status=:status WHERE id=:id',[':status',':id'],[$status,$id]);
            $equipe = new Equipe();
            $equipe->setStatus($status);
        }

        //Deletar
    }
?>