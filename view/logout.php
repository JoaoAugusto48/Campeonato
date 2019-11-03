<?php
    require_once('../controller/UsuarioController.php');

    $usuario = new UsuarioController();

    $usuario->logOut();
?>