<?php
    require_once('../Sql.php');
    require_once('../model/Usuario.php');

    class UsuarioDAO{
        private $sql;

        public function __construct(){
            $this->sql = new Sql();
        }

        public function login(string $user,string $password):bool{
            $resultado = $this->sql->query('SELECT * FROM usuario WHERE user= :user AND password= :password',[':user',':password'],[$user,$password]) ? true : false;
            return $resultado;
        }

        public function user(string $user,string $password):object{
            $resultado = $this->sql->query('SELECT * FROM usuario WHERE user= :user AND password= :password',[':user',':password'],[$user,$password])[0];
            $usuario = new Usuario();
            $usuario->setId($resultado->id);
            $usuario->setNome($resultado->nome);
            $usuario->setUser($user);
            return $usuario;
        }
        //Modificar
    }
?>