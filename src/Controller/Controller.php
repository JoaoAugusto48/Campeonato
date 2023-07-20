<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Helper\InvalidMessageTrait;
use App\Http\Helper\SuccessMessageTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class Controller implements RequestHandlerInterface
{
    use InvalidMessageTrait;
    use SuccessMessageTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // var_dump($request->getServerParams()['PATH_INFO']);
        // var_dump($request->getMethod());
        
        // var_dump(str_contains($request->getServerParams()['PATH_INFO'], '/create'));
        // var_dump($request->getQueryParams());
        // var_dump($request->getUri()->getPath());
        // exit;

        // Main - Methods
        if($request->getUri()->getPath() === '/') {
            if($request->getMethod() === 'GET') {
                return $this->index();
            }
        }

        // 'GET' - Methods
        if($request->getMethod() === 'GET') {

            if(str_contains($request->getServerParams()['PATH_INFO'], '/create')) {
                return $this->create($request);
            }
            
            if(str_contains($request->getServerParams()['PATH_INFO'], '/edit')) {
                $id = filter_var($request->getQueryParams()['id'] ?? '', FILTER_VALIDATE_INT);
                return $this->edit($request, $id);
            }

            if(str_contains($request->getServerParams()['PATH_INFO'], '/show')) {
                $id = filter_var($request->getQueryParams()['id'] ?? '', FILTER_VALIDATE_INT);
                return $this->show($request, $id);
            }

            return $this->index();
        }

        // 'POST' - Methods
        if($request->getMethod() === 'POST') {

            if(str_contains($request->getServerParams()['PATH_INFO'], '/create')) {
                return $this->store($request);
            }

            if(str_contains($request->getServerParams()['PATH_INFO'], '/delete')) {
                $id = filter_var($request->getParsedBody()['id'], FILTER_VALIDATE_INT);
                return $this->destroy($id);
            }

            if(isset($request->getQueryParams()['id'])) {
                $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);
                return $this->update($request, $id);
            }
        }

        $error404 = new Error404Controller();
        return $error404->handle($request);
    }
    
    abstract function index(): ResponseInterface;
    
    abstract function create(ServerRequestInterface $request): ResponseInterface;

    abstract function store(ServerRequestInterface $request): ResponseInterface;
    
    abstract function show(ServerRequestInterface $request, ?int $id): ResponseInterface;

    abstract function edit(ServerRequestInterface $request, ?int $id): ResponseInterface;
    
    abstract function update(ServerRequestInterface $request, int $id): ResponseInterface;

    abstract function destroy(int $id): ResponseInterface;

}