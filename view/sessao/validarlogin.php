<?php
define('__ROOT__', '../..');
require_once(__ROOT__ . '/controller/UsuarioController.php');

if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = $_POST['user'];
    $password = md5($_POST['password']);

    $usuario = new UsuarioController();

    $resultado = $usuario->login($user, $password);
    if ($resultado) {
        session_start();
        $sessao = $usuario->user($user, $password);

        $_SESSION['name'] = $sessao->getNome();
        $_SESSION['user'] = $sessao->getUser();

        header('Location: '. __ROOT__ .'/view/campeonato/menu.php');
        die();
    }
}
header('Location: '.__ROOT__.'/index.php');
