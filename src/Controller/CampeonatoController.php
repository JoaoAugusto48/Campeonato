<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Service\CampeonatoService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CampeonatoController extends Controller
{
    
    public function __construct(
        private CampeonatoService $campeonatoService,
        private Engine $templates
    ) 
    {
    }

    public function index(): ResponseInterface
    {
        $campeonatoList = $this->campeonatoService->findAll();

        return new Response(302, [],
            $this->templates->render(
                'campeonato/campeonato-list',
                ['campeonatoList' => $campeonatoList]
            )
        );
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        return new Response;
    }

    public function store(ServerRequestInterface $request): ResponseInterface
    {
        return new Response;
    }

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        return new Response;
    }

    public function edit(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        return new Response;
    }

    public function update(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        return new Response;
    }

    public function destroy(int $id): ResponseInterface
    {
        return new Response;
    }

}