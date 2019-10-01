<<<<<<< HEAD
<?php
    require_once('../Sql.php');
    require_once('../model/Estatistica.php');

    class EstatisticaDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        //Listas
        public function Jogos(int $id, int $vitoria, int $empate, int $derrota):int{
            $resultado = $this->sql->query('SELECT ((:vitoria)+(:empate)+(:derrota)) AS jogos FROM estatistica WHERE id=:id',[':vitoria',':empate',':derrota',':id'],[$vitoria,$empate,$derrota,$id])[0];
            return $resultado->jogos;
        }

        public function Pontos(int $id, int $vitoria, int $empate):int{
            $resultado = $this->sql->query('SELECT ((:vitoria*3)+(:empate)) AS pontos FROM estatistica WHERE id=:id',[':vitoria',':empate',':id'],[$vitoria,$empate,$id])[0];
            return $resultado->pontos;
        }

        public function listarPorCampeonato(int $id_campeonato):array{
            $resultados = $this->sql->query('SELECT e.id, e.vitoria, e.empate, e.derrota, e.golpro, e.golcontra, e.idequipe, e.idcampeonato, eq.nome as nomeequipe FROM estatistica AS e LEFT JOIN equipe AS eq ON e.idcampeonato=:id_campeonato where e.idequipe=eq.id GROUP BY e.idequipe',[':id_campeonato'],[$id_campeonato]);
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
                $estatistica->getEquipe()->setNome($resultado->nomeequipe);

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
=======
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
>>>>>>> 04f6116eb9f2ad714e84a935ae8d64e67a8b762a
?>