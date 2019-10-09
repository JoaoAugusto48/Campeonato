<?php
    require_once('../Sql.php');
    require_once('../model/Estatistica.php');

    class EstatisticaDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        //Listas
        public function jogos(int $id, int $vitoria, int $empate, int $derrota):int{
            $resultado = $this->sql->query('SELECT ((:vitoria)+(:empate)+(:derrota)) AS jogos FROM estatistica WHERE id=:id',[':vitoria',':empate',':derrota',':id'],[$vitoria,$empate,$derrota,$id])[0];
            return $resultado->jogos;
        }

        public function pontos(int $id, int $vitoria, int $empate):int{
            $resultado = $this->sql->query('SELECT ((:vitoria*3)+(:empate)) AS pontos FROM estatistica WHERE id=:id',[':vitoria',':empate',':id'],[$vitoria,$empate,$id])[0];
            return $resultado->pontos;
        }

        public function nVitoria(int $id, int $vitoria):int{
            $resultado = $this->sql->query('SELECT (:vitoria) AS vitoria FROM estatistica WHERE id=:id',[':vitoria',':id'],[$vitoria,$id])[0];
            return $resultado->vitoria;
        }

        public function saldoGol(int $id,int $golpro,int $golcontra):int{
            $resultado = $this->sql->query('SELECT (:golpro-:golcontra) AS saldo FROM estatistica WHERE id=:id',[':golpro','golcontra',':id'],[$golpro,$golcontra,$id])[0];
            return $resultado->saldo;
        }

        public function golsMarcados(int $id,int $golpro):int{
            $resultado = $this->sql->query('SELECT (:golpro) AS golpro FROM estatistica WHERE id=:id',[':golpro',':id'],[$golpro,$id])[0];
            return $resultado->golpro;
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
        public function atualizarVitoria(int $idcampeonato,int $vencedor,int $ngolfeito, int $ngolsofrido):void{
            $resultado = $this->sql->query('UPDATE estatistica SET golpro=(golpro+:ngolfeito), golcontra=(golcontra+:ngolsofrido), vitoria=(vitoria+1) WHERE idcampeonato=:idcampeonato AND idequipe=:vencedor',
                        [':ngolfeito',':ngolsofrido',':idcampeonato',':vencedor'],
                        [$ngolfeito,$ngolsofrido,$idcampeonato,$vencedor]);
            $estatistica = new Estatistica();
            $estatistica->setIdCampeonato($idcampeonato);
            $estatistica->setIdEquipe($vencedor);
            $estatistica->setGolPro($ngolfeito);
            $estatistica->setGolContra($ngolsofrido);
        }

        public function atualizarDerrota(int $idcampeonato,int $derrotado,int $ngolfeito,int $ngolsofrido):void{
            $resultado = $this->sql->query('UPDATE estatistica SET golpro=(golpro+:ngolfeito), golcontra=(golcontra+:ngolsofrido), derrota=(derrota+1) WHERE idcampeonato=:idcampeonato AND idequipe=:derrotado',
                        [':ngolfeito',':ngolsofrido',':idcampeonato',':derrotado'],
                        [$ngolfeito,$ngolsofrido,$idcampeonato,$derrotado]);
            $estatistica = new Estatistica();
            $estatistica->setIdCampeonato($idcampeonato);
            $estatistica->setIdEquipe($derrotado);
            $estatistica->setGolPro($ngolfeito);
            $estatistica->setGolContra($ngolsofrido);
        }

        public function atualizarEmpate(int $idcampeonato,int $empate,int $ngolsofrido,int $ngolfeito):void{
            $resultado = $this->sql->query('UPDATE estatistica SET golpro=(golpro+:ngolfeito), golcontra=(golcontra+:ngolsofrido), empate=(empate+1) WHERE idcampeonato=:idcampeonato AND idequipe=:empate',
                        [':ngolfeito',':ngolsofrido',':idcampeonato',':empate'],
                        [$ngolfeito,$ngolsofrido,$idcampeonato,$empate]);
            $estatistica = new Estatistica();
            $estatistica->setIdCampeonato($idcampeonato);
            $estatistica->setIdEquipe($empate);
            $estatistica->setGolPro($ngolfeito);
            $estatistica->setGolContra($ngolsofrido);
        }

        public function anteriorVitoria(int $idcampeonato,int $vencedor,int $ngolfeito, int $ngolsofrido):void{
            $this->sql->query('UPDATE estatistica SET golpro=(golpro-:ngolfeito), golcontra=(golcontra-:ngolsofrido), vitoria=(vitoria-1) WHERE idcampeonato=:idcampeonato AND idequipe=:vencedor',
                    [':ngolfeito',':ngolsofrido',':idcampeonato',':vencedor'],
                    [$ngolfeito,$ngolsofrido,$idcampeonato,$vencedor]);
        }

        public function anteriorDerrota(int $idcampeonato,int $derrotado,int $ngolfeito, int $ngolsofrido):void{
            $this->sql->query('UPDATE estatistica SET golpro=(golpro-:ngolfeito), golcontra=(golcontra-:ngolsofrido), derrota=(derrota-1) WHERE idcampeonato=:idcampeonato AND idequipe=:derrotado',
                    [':ngolfeito',':ngolsofrido',':idcampeonato',':derrotado'],
                    [$ngolfeito,$ngolsofrido,$idcampeonato,$derrotado]);
        }

        public function anteriorEmpate(int $idcampeonato,int $empate,int $ngolfeito, int $ngolsofrido):void{
            $this->sql->query('UPDATE estatistica SET golpro=(golpro-:ngolfeito), golcontra=(golcontra-:ngolsofrido), empate=(empate-1) WHERE idcampeonato=:idcampeonato AND idequipe=:empate',
                    [':ngolfeito',':ngolsofrido',':idcampeonato',':empate'],
                    [$ngolfeito,$ngolsofrido,$idcampeonato,$empate]);
        }

        //Deletar (logicamente)

        //Deletar
    }
?>