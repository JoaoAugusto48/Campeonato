<?php
    require_once('../Sql.php');
    require_once('../model/Equipe.php');

    class EquipeDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        //Listas
        public function listarPorNome():array{
            $resultados = $this->sql->query('SELECT e.id, e.nome, e.sigla, e.idPais, p.nome as nomepais FROM equipe AS e JOIN pais AS p on e.idpais = p.id order by e.nome',[],[]);
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
            $resultados = $this->sql->query('SELECT e.id, e.nome, e.sigla, e.idPais, p.nome as nomepais FROM equipe AS e JOIN pais AS p ON e.idpais = p.id WHERE e.id=:id',[':id'],[$id])[0];
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
            $inserir = $this->sql->query('INSERT INTO equipe (nome, sigla, idpais) VALUES (:nome, :sigla, :idpais)',[':nome', ':sigla', ':idpais'],[$nome, $sigla, $idPais]);
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

        //Deletar
    }

/*   $nome = trim($_POST['txtNome']);
    $sigla = trim($_POST['txtSigla']);
    $pais = trim($_POST['idPais']);

    $sigla = strtoupper($sigla);

    if(!empty($nome) && !empty($sigla) && !empty($pais)){
        require_once('Banco.php');
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO equipe (nome, sigla, idpais) VALUES (?, ?, ?);";
        $qry = $pdo->prepare($sql);
        $qry->execute(array($nome, $sigla, $pais));
        Banco::desconectar();
    }
    header('location: lstEquipe.php');
*/
?>