<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Campeonato</title>
    <link href="/css/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> <!-- //https://fontawesome.com/v4.7.0/get-started/?utm_source=fontawesome4.7  -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
</head>
<body>
    <div class="page-container">
        <?= $this->insert('header') ?>

        <div class="container content-wrap">
            <?= $this->section('content') ?>
        </div>

        <?= $this->insert('footer') ?>

        <script src="/css/bootstrap-5.3.0/js/bootstrap.min.js"></script>
    </div>
</body>

</html>