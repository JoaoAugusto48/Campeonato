<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Entity\Equipe;

use App\Http\DTO\EquipeFormDTO;
use App\Http\DTO\EquipeDTO;
use App\Http\DTO\PaisDTO;

use App\Http\Service\EquipeService;
use App\Http\Service\PaisService;

use Nyholm\Psr7\Response;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EquipeController extends Controller
{

    public function __construct(
        private EquipeService $equipeService,
        private Engine $templates,

        private PaisService $paisService
    ) {
    }

    public function index(): ResponseInterface
    {
        $equipes = $this->equipeService->findAll();
        $equipeList = EquipeDTO::equipeDTOList($equipes);
        
        return new Response(302, [],
            $this->templates->render(
                'equipe/equipe-list',
                ['equipeList' => $equipeList]
            )
        );
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        $paisList = PaisDTO::paisDTOList($this->paisService->findAll());
        
        return new Response(302, [],
            $this->templates->render(
                'equipe/equipe-form',
                [
                    'equipe' => null,
                    'paisList' => $paisList
                ]
            )
        );
    }

    public function store(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $equipeData = new EquipeFormDTO($request->getParsedBody());
            
            $this->equipeService->save(
                new Equipe(
                    $equipeData->nome, 
                    $equipeData->sigla, 
                    $equipeData->paisId
                )
            );

            $this->addSuccessMessage("Equipe '{$equipeData->nome}' cadastrada com sucesso.");
            return new Response(302, [
                    'Location' => '/equipes',
                    'method' => 'GET'
                ]    
            );
        } catch (\Throwable $e) {
            
            $this->addErrorMessage($e->getMessage());
            return new Response(302, [
                    'Location' => '/equipes/create',
                    'method' => 'GET'
                ]    
            );
        }
    }

    public function show(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        return new Response;
    }

    public function edit(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        /** @var ?Equipe $equipe */
        $equipeResult = $this->equipeService->findById($id);
        $equipe = EquipeDTO::getEquipeDTO($equipeResult);

        $paises = $this->paisService->findAll();
        $paisList = PaisDTO::paisDTOList($paises);

        return new Response(302, [],
            $this->templates->render(
                'equipe/equipe-form',
                [
                    'equipe' => $equipe,
                    'paisList' => $paisList
                ]
            )
        );
    }

    public function update(ServerRequestInterface $request, int $id): ResponseInterface
    {
        try {
            $equipe = $this->equipeService->findById($id);
            $equipeData = new EquipeFormDTO($request->getParsedBody(), $id);
            
            $equipe->setId($equipeData->id);
            $equipe->setNome($equipeData->nome);
            $equipe->setSigla($equipeData->sigla);
            $equipe->setPaisId($equipeData->paisId);

            $this->equipeService->save($equipe);
            
            $this->addSuccessMessage("Equipe '{$equipe->getNome()}' atualizada com sucesso.");
            return new Response(302, [
                    'Location' => '/equipes',
                    'method' => 'GET'
                ]    
            );
        } catch (\Throwable $e) {
            
            $this->addErrorMessage($e->getMessage());
            return new Response(302, [
                    'Location' => '/equipes/edit?id=' . $id,
                    'method' => 'GET'
                ]    
            );
        }
    }

    public function destroy(int $id): ResponseInterface
    {
        try {
            $this->equipeService->delete($id);
            
            $this->addSuccessMessage('Equipe deletada com sucesso');
        } catch (\Throwable $th) {
            $this->addErrorMessage($th->getMessage());
            // $this->addErrorMessage('Não foi possível deletar a Equipe');
        }

        return new Response(302, [
            'Location' => '/equipes',
            'method' => 'GET'
        ]);
    }

}