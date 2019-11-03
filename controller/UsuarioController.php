<?php
    require_once('../DAO/UsuarioDAO.php');

    class UsuarioController{

        private $usuarioDAO;
        
        public function __construct(){
            $this->usuarioDAO = new UsuarioDAO();
        }

        public function login(string $user,string $password):bool{
            return $this->usuarioDAO->login($user,$password);
        }

        public function user(string $user,string $password):object{
            return $this->usuarioDAO->user($user,$password);
        }

        public function sessao():void{
            $status = session_status();
            if($status == PHP_SESSION_NONE){
                session_start();
            }
            if(!isset($_SESSION['user'])){
                header("Location: index.html");
            }
            //var_dump($_SESSION['name']);
            //var_dump($_SESSION['user']);
        }

        public function logOut():void{
            session_start();
            session_destroy();

            header('Location: index.html');
            exit();
        }
        //Modificar
    }

?>