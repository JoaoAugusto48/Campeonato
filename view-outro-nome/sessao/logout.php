<?php
define('__ROOT__', '../..');
require_once(__ROOT__ . '/controller/UsuarioController.php');

$usuario = new UsuarioController();

$usuario->logOut();
