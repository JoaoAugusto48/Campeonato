<?php 

declare(strict_types=1);

namespace App\Http\Controller;

use App\Http\Entity\Campeonato;

use App\Http\DTO\CampeonatoFormDTO;
use App\Http\DTO\CampeonatoDTO;
use App\Http\DTO\EstatisticaDTO;
use App\Http\DTO\PartidaDTO;
use App\Http\DTO\RodadaDTO;

use App\Http\Enum\RegiaoEnum;

use App\Http\Service\CampeonatoService;
use App\Http\Service\EstatisticaService;
use App\Http\Service\EquipeService;
use App\Http\Service\PartidaService;

use Nyholm\Psr7\Response;
use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CampeonatoController extends Controller
{
    
    public function __construct(
        private CampeonatoService $campeonatoService,
        private Engine $templates,

        private EstatisticaService $estatisticaService,
        private PartidaService $partidaService,
        private EquipeService $equipeService,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $route = parent::handle($request);

        if(!isset($request->getServerParams()['PATH_INFO'])) {
            return $route;
        }
        
        if($request->getMethod() === 'GET') {
            if(str_contains($request->getServerParams()['PATH_INFO'], '/equipes')){
                $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);
                return $this->viewAddEquipes($request, $id);
            }
        }

        if($request->getMethod() === 'POST') {
            if(str_contains($request->getServerParams()['PATH_INFO'], '/activate')) {
                $id = filter_var($request->getParsedBody()['id'], FILTER_VALIDATE_INT);
                return $this->activate($request, $id);
            }
        }
        return $route;
    }

    public function index(): ResponseInterface
    {
        $campeonatoList = CampeonatoDTO::campeonatoDTOList($this->campeonatoService->findAll());

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
            )
        );
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
            $this->campeonatoService->save($camp);

            $this->addSuccessMessage("Campeonato '{$camp->getNome()}' cadastrado com sucesso.");
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
        $campeonato = CampeonatoDTO::getCampeonatoDTO($this->campeonatoService->findById($id));
        $estatisticaList = EstatisticaDTO::estatisticaDTOList($this->estatisticaService->findByCampeonatoId($campeonato->id));
        $partidaList = PartidaDTO::partidaDTOList($this->partidaService->findAllByCampeonatoId($campeonato->id));

        $partidasMap = RodadaDTO::fillPartidaMap($partidaList);

        return new Response(302, [],
            $this->templates->render(
                'campeonato/campeonato-show',
                [
                    'campeonato' => $campeonato,
                    'estatisticaList' => $estatisticaList,
                    'partidasMap' => $partidasMap,
                ]
            )
        );
    }

    public function edit(ServerRequestInterface $request, ?int $id): ResponseInterface
    {
        /** @var ?Campeonato $campeonato */
        $campeonato = CampeonatoDTO::getCampeonatoDTO($this->campeonatoService->findById($id));
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
            $camp = $this->campeonatoService->findById($id);

            $campData = new CampeonatoFormDTO($request->getParsedBody(), $id);
            
            $camp->setNome($campData->nome);
            $camp->setRegiao($campData->regiao);
            $camp->setNumFases($campData->numFases);
            $camp->setNumEquipes($campData->numEquipes);
            $camp->setNumTurnos($campData->numTurnos);
            $camp->setTemporada($campData->temporada);
            $camp->setRodadas($campData->rodadas);

            $this->campeonatoService->save($camp);

            $this->addSuccessMessage("Campeonato '{$camp->getNome()}' atualizado com sucesso.");
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
            $this->campeonatoService->delete($id);
            
            $this->addSuccessMessage('Campeonato deletado com sucesso');
        } catch (\Throwable $th) {
            $this->addErrorMessage('Não foi possível deletar o Campeonato');
        }

        return new Response(302, [
            'Location' => '/',
            'method' => 'GET'
        ]);
    }

    public function activate(ServerRequestInterface $request, int $id): ResponseInterface
    {
        $oldUrl = $request->getServerParams()['HTTP_REFERER'];
        try {
            $campData = CampeonatoDTO::getCampeonatoDTO($this->campeonatoService->findById($id));

            $equipeList = $this->estatisticaService->findByCampeonatoId($id);

            if($campData->ativado) {
                throw new \LengthException('Campeonato não pode ser ativado novamente.');
            }

            if($campData->numEquipes !== sizeof($equipeList)) {
                throw new \LengthException("Número de equipes cadastradas não é correspondente ao número exigido '{$campData->numEquipes}'.");
            }

            $campNew = new Campeonato(
                $campData->nome,
                $campData->regiao,
                $campData->numFases,
                $campData->numEquipes,
                $campData->numTurnos,
                $campData->temporada,
                $campData->rodadas,
                $campData->rodadaAtual,
                id: $campData->id,
                ativado: true
            );

            $this->campeonatoService->activateCampeonato($campNew);
            
            $this->addSuccessMessage('Inserir área de ativação do campeonato');
        } catch (\Throwable $th) {
            $this->addErrorMessage($th->getMessage());    
        }

        return new Response(302, [
            'Location' => $oldUrl,
            'method' => 'GET'
        ]);
    }

    public function viewAddEquipes(ServerRequestInterface $request, int $id): ResponseInterface
    {
        $oldUrl = $request->getServerParams()['HTTP_REFERER'];
        $campeonato = $this->campeonatoService->findById($id);
        $equipeList = $this->equipeService->findAll();

        return new Response(302, [], 
            $this->templates->render(
                'campeonato/equipes/equipe-add-form',
                [
                    'campeonato' => $campeonato,
                    'lastUrl' => $oldUrl,
                    'equipeList' => $equipeList,
                ]
            )
        );
    }   

}