<?php

declare(strict_types=1);

return [
    // Paises
    'GET|/paises' => \App\Http\Controller\PaisController::class, // index
    'GET|/paises/create' => \App\Http\Controller\PaisController::class, // create
    'POST|/paises/create' => \App\Http\Controller\PaisController::class, // store / update
    'GET|/paises/show' => \App\Http\Controller\PaisController::class, // show
    'GET|/paises/edit' => \App\Http\Controller\PaisController::class, // edit
    'POST|/paises/edit' => \App\Http\Controller\PaisController::class, // update
    'POST|/paises/delete' => \App\Http\Controller\PaisController::class, // destroy 
];