<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Entity\Pais;

use App\Http\DTO\PaisFormDTO;
use App\Http\DTO\PaisDTO;

use App\Http\Service\PaisService;

use Nyholm\Psr7\Response;
use League\Plates\Engine;
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
        $paisList = PaisDTO::paisDTOList($this->paisService->findAll());

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
        $paisData = new PaisFormDTO($request->getParsedBody());
        try {
            $this->paisService->save(new Pais($paisData->nome, $paisData->sigla));

            $this->addSuccessMessage("País '{$paisData->nome}' criado com sucesso.");
            return new Response(302, [
                    'Location' => '/paises',
                    'method' => 'GET'
                ]
            );
        } catch (\Throwable $e) {
            
            $this->addErrorMessage($e->getMessage());
            return new Response(302, [], 
                $this->templates->render(
                    'pais/pais-form',
                    ['pais' => $paisData]
                )
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
        $paisResult = $this->paisService->findById($id);
        $pais = PaisDTO::getPaisDTO($paisResult);

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
            $pais = $this->paisService->findById($id);

            $paisData = new PaisFormDTO($request->getParsedBody(), $id);
            $pais->setNome($paisData->nome);
            $pais->setSigla($paisData->sigla);
            
            $this->paisService->save($pais);
            
            $this->addSuccessMessage("País '{$pais->getNome()}' atualizado com sucesso.");
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
            $this->paisService->delete($id);
            $this->addSuccessMessage("País deletado com sucesso.");
        } catch (\Throwable) {
            $this->addErrorMessage("Não foi possível deletar o País.");
        }

        return new Response(302, [
            'Location' => '/paises',
            'method' => 'GET'
        ]);
    } 

}