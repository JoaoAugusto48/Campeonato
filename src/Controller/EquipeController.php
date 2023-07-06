<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Entity\Equipe;
use App\Http\Entity\Pais;
use App\Http\Service\EquipeService;
use App\Http\Service\PaisService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class EquipeController extends Controller
{

    public function __construct(
        private EquipeService $equipeService,
        private Engine $templates,

        private PaisService $paisService
    ) 
    {
    }

    public function index(): ResponseInterface
    {
        $equipeList = $this->equipeService->findAll();
        
        return new Response(302, [],
            $this->templates->render(
                'equipe/equipe-list',
                ['equipeList' => $equipeList]
            )
        );
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        $equipe = null;
        $paisList = $this->paisService->findAll();

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

    public function store(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $equipeData = $request->getParsedBody();            
            $pais = Pais::paisDecode($equipeData['pais']);

            $equipe = new Equipe(
                $equipeData['nome'],
                $equipeData['sigla'],
                $pais
            );

            $result = $this->equipeService->insert($equipe);

            if(!$result){
                throw new \RuntimeException();
            }

            $this->addSuccessMessage("Equipe '$equipe->nome' cadastrada com sucesso.");
            return new Response(302, [
                    'Location' => '/equipes',
                    'method' => 'GET'
                ]    
            );
        } catch (\RuntimeException $e) {
            
            $this->addErrorMessage($e->getMessage());
            return new Response(302, [
                    'Location' => '/equipes/create',
                    'method' => 'GET'
                ]    
            );
        }
    }

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        return new Response;
    }

    public function edit(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        /** @var ?Equipe $equipe */
        $equipe = $this->equipeService->findById($id);
        $paisList = $this->paisService->findAll();

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
            $equipeData = $request->getParsedBody();            
            $pais = Pais::paisDecode($equipeData['pais']);

            $equipe = new Equipe(
                $equipeData['nome'],
                $equipeData['sigla'],
                $pais
            );
            $equipe->setId($id);

            $result = $this->equipeService->update($equipe);
            if(!$result){
                throw new \RuntimeException();
            }

            $this->addSuccessMessage("Equipe '$equipe->nome' atualizada com sucesso.");
            return new Response(302, [
                    'Location' => '/equipes',
                    'method' => 'GET'
                ]    
            );
        } catch (\RuntimeException $e) {
            
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
            $result = $this->equipeService->delete($id);
            if(!$result){
                throw new \RuntimeException();
            }

            $this->addSuccessMessage('Equipe deletada com sucesso');
        } catch (\Throwable $th) {
            $this->addErrorMessage('Não foi possível deletar a Equipe');
        }

        return new Response(302, [
            'Location' => '/equipes',
            'method' => 'GET'
        ]);
    }

}