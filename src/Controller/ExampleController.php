<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExampleController extends Controller
{
    
    public function __construct(
        // private ExampleService $exampleService,
        // private Engine $templates
    ) 
    {
    }

    public function index(): ResponseInterface
    {
        return new Response;
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