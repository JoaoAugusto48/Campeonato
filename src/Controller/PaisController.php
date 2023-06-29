<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Entity\Pais;
use App\Http\Repository\PaisRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PaisController extends Controller
{

    public function __construct(
        private PaisRepository $paisRepository,
        private Engine $templates
    ) {
    }

    public function index(): ResponseInterface
    {
        $paisList = $this->paisRepository->listOrderedByNome();
        return new Response(302, [], 
            $this->templates->render(
                'pais/pais-list', 
                ['paisList' => $paisList]
            )
        );
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        $pais = null;
        return new Response(302, [], 
            $this->templates->render(
                'pais/pais-form', 
                ['pais' => $pais]
            )
        );
    } 

    public function store(ServerRequestInterface $request): ResponseInterface
    {
        $paisData = $request->getParsedBody();
        $pais = new Pais(
            $paisData['nome'],
            $paisData['sigla']
        );
        
        $success = $this->paisRepository->add($pais);
        if($success === false){
            return new Response(302, [
                    'method' => 'GET'
                ], 
            $this->templates->render(
                'paises/create',
                ['error' => $success]
            ));
        }

        return new Response(302, [
            'Location' => '/paises'
        ]);
    } 

    public function show(ServerRequestInterface $request): ResponseInterface
    {
        return new Response();
    }

    public function edit(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        /** @var ?Pais $pais */
        $pais = $this->paisRepository->findById($id);

        return new Response(302, [], 
            $this->templates->render(
                'pais/pais-form', 
                ['pais' => $pais]
            )
        );
    }

    public function update(ServerRequestInterface $request, int $id): ResponseInterface
    {
        $paisData = $request->getParsedBody();
        $pais = new Pais(
            $paisData['nome'],
            $paisData['sigla']
        );
        $pais->setId($id);
        
        $this->paisRepository->update($pais);
        
        return new Response(302, [
            'Location' => '/paises'
        ]);
    } 

    public function destroy(int $id): ResponseInterface
    {
        $pais = $this->paisRepository->findById($id);
        
        $removed = false;
        if(!is_null($pais)){
            $removed = $this->paisRepository->delete($id);
        }
        
        if($removed === false) {
            // não removeu
            return new Response(302, [
                'Location' => '/paises'
            ]);
        }
        
        return new Response(302, [
            'Location' => '/paises'
        ]);
    } 

}