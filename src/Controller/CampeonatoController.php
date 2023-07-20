<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\DTO\CampeonatoFormDTO;
use App\Http\Entity\Campeonato;
use App\Http\Enum\RegiaoEnum;
use App\Http\Service\CampeonatoService;
use App\Http\Service\EstatisticaService;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CampeonatoController extends Controller
{
    
    public function __construct(
        private CampeonatoService $campeonatoService,
        private Engine $templates,

        private EstatisticaService $estatisticaService,
    ) {
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
        $regiaoList = RegiaoEnum::cases();
        
        return new Response(302, [], 
            $this->templates->render(
                'campeonato/campeonato-form',
                [
                    'regiaoList' => $regiaoList,
                    'campeonato' => null
                ]
            ));
    }

    public function store(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $campData = new CampeonatoFormDTO($request->getParsedBody());
            $camp = new Campeonato(
                $campData->nome,
                $campData->regiao,
                $campData->numFases,
                $campData->numEquipes,
                $campData->numTurnos,
                $campData->temporada,
                $campData->rodadas
            );
            $result = $this->campeonatoService->save($camp);

            if(!$result){
                throw new \RuntimeException();
            }

            $this->addSuccessMessage("Campeonato '{$camp->nome}' cadastrado com sucesso.");
            return new Response(302, [
                    'Location' => '/',
                    'method' => 'GET'
                ]
            );
        } catch (\Throwable $th) {
            
            $this->addErrorMessage($th->getMessage());
            return new Response(302, [
                    'Location' => '/campeonatos/create',
                    'method' => 'GET'
                ]
            );
        }
        
    }

    public function show(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        $campeonato = $this->campeonatoService->findById($id);
        $estatisticaList = $this->estatisticaService->findByCampeonatoId($campeonato->id);

        return new Response(302, [],
            $this->templates->render(
                'campeonato/campeonato-show',
                [
                    'campeonato' => $campeonato,
                    'estatisticaList' => $estatisticaList
                ]
            )
        );
    }

    public function edit(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        /** @var ?Campeonato $campeonato */
        $campeonato = $this->campeonatoService->findById($id);
        $regiaoList = RegiaoEnum::cases();

        return new Response(302, [], 
            $this->templates->render(
                'campeonato/campeonato-form',
                [
                    'campeonato' => $campeonato,
                    'regiaoList' => $regiaoList
                ]
            )
        );
    }

    public function update(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        try {
            $campData = new CampeonatoFormDTO($request->getParsedBody(), $id);
            $camp = new Campeonato(
                $campData->nome,
                $campData->regiao,
                $campData->numFases,
                $campData->numEquipes,
                $campData->numTurnos,
                $campData->temporada,
                $campData->rodadas,
                $campData->id
            );
            $result = $this->campeonatoService->save($camp);

            if(!$result){
                throw new \RuntimeException();
            }

            $this->addSuccessMessage("Campeonato '{$camp->nome}' atualizado com sucesso.");
            return new Response(302, [
                    'Location' => '/',
                    'method' => 'GET'
                ]
            );
        } catch (\Throwable $th) {
            
            $this->addErrorMessage($th->getMessage());
            return new Response(302, [
                    'Location' => '/campeonatos/edit?id='.$id,
                    'method' => 'GET'
                ]
            );
        }
    }

    public function destroy(int $id): ResponseInterface
    {
        try {
            $result = $this->campeonatoService->delete($id);
            
            if(!$result){
                throw new \RuntimeException();
            }
            
            $this->addSuccessMessage('Campeonato deletado com sucesso');
        } catch (\Throwable $th) {
            $this->addErrorMessage('Não foi possível deletar o Campeonato');
        }

        return new Response(302, [
            'Location' => '/',
            'method' => 'GET'
        ]);
    }

}