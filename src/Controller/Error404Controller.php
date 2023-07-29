<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Error404Controller implements RequestHandlerInterface
{
    public static function getInstance(): Error404Controller
    {
        return new Error404Controller();
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(404);
    }

}