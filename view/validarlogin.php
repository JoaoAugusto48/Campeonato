<?php
    require_once('../controller/UsuarioController.php');

    if(isset($_POST['user']) && isset($_POST['password'])){
        $user = $_POST['user'];
        $password = md5($_POST['password']);

        $usuario = new UsuarioController();

        $resultado = $usuario->login($user,$password);
        if($resultado){
            session_start();
            $sessao = $usuario->user($user,$password);
            
            $_SESSION['name']=$sessao->getNome();
            $_SESSION['user']=$sessao->getUser();
            
            header('Location: menu');
            die();
        }   
    }
    header('Location: index.html');
    

?>