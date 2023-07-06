<?php

declare(strict_types=1);

return [
    // main
    'GET|/' => \App\Http\Controller\CampeonatoController::class,

    // Paises
    'GET|/paises' => \App\Http\Controller\PaisController::class, // index
    'GET|/paises/create' => \App\Http\Controller\PaisController::class, // create
    'POST|/paises/create' => \App\Http\Controller\PaisController::class, // store / update
    'GET|/paises/show' => \App\Http\Controller\PaisController::class, // show
    'GET|/paises/edit' => \App\Http\Controller\PaisController::class, // edit
    'POST|/paises/edit' => \App\Http\Controller\PaisController::class, // update
    'POST|/paises/delete' => \App\Http\Controller\PaisController::class, // destroy 

    // Equipes
    'GET|/equipes' => \App\Http\Controller\EquipeController::class, // index
    'GET|/equipes/create' => \App\Http\Controller\EquipeController::class, // create
    'POST|/equipes/create' => \App\Http\Controller\EquipeController::class, // store / update
    'GET|/equipes/show' => \App\Http\Controller\EquipeController::class, // show
    'GET|/equipes/edit' => \App\Http\Controller\EquipeController::class, // edit
    'POST|/equipes/edit' => \App\Http\Controller\EquipeController::class, // update
    'POST|/equipes/delete' => \App\Http\Controller\EquipeController::class, // destroy 

    // Campeonatos
    'GET|/campeonatos' => \App\Http\Controller\CampeonatoController::class, // index
    'GET|/campeonatos/create' => \App\Http\Controller\CampeonatoController::class, // create
    'POST|/campeonatos/create' => \App\Http\Controller\CampeonatoController::class, // store / update
    'GET|/campeonatos/show' => \App\Http\Controller\CampeonatoController::class, // show
    'GET|/campeonatos/edit' => \App\Http\Controller\CampeonatoController::class, // edit
    'POST|/campeonatos/edit' => \App\Http\Controller\CampeonatoController::class, // update
    'POST|/campeonatos/delete' => \App\Http\Controller\CampeonatoController::class, // destroy 
];