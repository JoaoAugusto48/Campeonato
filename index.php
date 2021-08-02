<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Campeonato</title>

    <link rel="stylesheet" href="view/css/style.css">
    <link href="view/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="view/css/bootstrap/js/bootstrap.min.js"></script>
</head>

<body class="d-flex align-items-center bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card border border-secondary shadow-lg">
                    <div class="card-header text-center">
                        Campeonato
                    </div>
                    <div class="card-body">
                        <div class="card-text pt-3">
                            <form action="view/sessao/validarlogin.php" method="post">
                                <div class="row justify-content-center">
                                    <div class="col-8 mb-3">
                                        <label for="login" class="form-label">Login:</label>
                                        <input type="text" class="form-control" name="user" autocomplete="off" id="login" placeholder="User name">
                                    </div>
                                    <div class="col-8 mb-3">
                                        <label for="senha" class="form-label">Senha:</label>
                                        <input type="password" class="form-control" name="password" id="senha" placeholder="Senha">
                                    </div>
                                    <div class="col-8 mb-3">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <a class="text-decoration-none" href="view/usuario/cadastroUsuario.php">Deseja se cadastrar?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>