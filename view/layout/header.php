<?php
require_once(__ROOT__ . '/controller/UsuarioController.php');
$usuario = new UsuarioController();

$usuario->sessao();
// $titulo - é o titulo da página
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titulo ?></title>
    <link href="<?= __ROOT__ ?>/view/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> <!-- //https://fontawesome.com/v4.7.0/get-started/?utm_source=fontawesome4.7  -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3 mb-4">
                <table class="float-end">
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                <h6 class="m-0">Olá <?= $_SESSION['name'] ?></h6>
                            </td>
                            <td class="align-middle"><input type="button" class="btn btn-outline-danger" value="Log Out" onclick="javascript: location.href='logout'"></td>
                        </tr>
                    </tbody>
                </table>