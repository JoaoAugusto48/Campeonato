<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\DTO\PaisFormDTO;
use App\Http\Entity\Pais;
use App\Http\Service\PaisService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PaisController extends Controller
{

    public function __construct(
        private PaisService $paisService,
        private Engine $templates
    ) {
    }

    public function index(): ResponseInterface
    {
        $paisList = $this->paisService->findAll();

        return new Response(302, [], 
            $this->templates->render(
                'pais/pais-list', 
                ['paisList' => $paisList]
            )
        );
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        
        return new Response(302, [], 
            $this->templates->render(
                'pais/pais-form', 
                ['pais' => null]
            )
        );
    } 

    public function store(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $paisData = new PaisFormDTO($request->getParsedBody());
            $pais = new Pais($paisData->nome, $paisData->sigla);
            
            $result = $this->paisService->save($pais);
            if(!$result){
                throw new \RuntimeException('Ocorreu um erro e não foi possível adicionar o País.');
            }

            $this->addSuccessMessage("País '{$pais->nome}' criado com sucesso.");
            return new Response(302, [
                'Location' => '/paises',
                'method' => 'GET'
            ]);
        } catch (\RuntimeException $e) {
            
            $this->addErrorMessage($e->getMessage());
            return new Response(302, [
                    'Location' => '/paises/create', 
                    'method' => 'GET'
                ]
            );
        }
    } 

    public function show(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        return new Response();
    }

    public function edit(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        /** @var ?Pais $pais */
        $pais = $this->paisService->findById($id);

        return new Response(302, [], 
            $this->templates->render(
                'pais/pais-form', 
                ['pais' => $pais]
            )
        );
    }

    public function update(ServerRequestInterface $request, int $id): ResponseInterface
    {
        try {
            $paisData = new PaisFormDTO($request->getParsedBody(), $id);
            $pais = new Pais($paisData->nome, $paisData->sigla, $paisData->id);
            
            $result = $this->paisService->save($pais);
            if(!$result){
                throw new \RuntimeException();
            }
            
            $this->addSuccessMessage("País '{$pais->nome}' atualizado com sucesso.");
            return new Response(302, [
                'Location' => '/paises',
                'method' => 'GET'
            ]);
        } catch (\Throwable $th) {
            
            $this->addErrorMessage($th->getMessage());
            return new Response(302, [
                'Location' => '/paises/edit?id=' . $id,
                'method' => 'GET'
            ]);
        }
    } 

    public function destroy(int $id): ResponseInterface
    {
        try {
            $result = $this->paisService->delete($id);

            if(!$result) {
                throw new \RuntimeException();
            }
            
            $this->addSuccessMessage("País deletado com sucesso.");
        } catch (\Throwable) {
            // não removeu
            $this->addErrorMessage("Não foi possível deletar o País.");
        }

        return new Response(302, [
            'Location' => '/paises',
            'method' => 'GET'
        ]);
    } 

}