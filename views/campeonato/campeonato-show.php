<?php
$this->layout('layout');
/** @var \App\Http\Entity\Campeonato $campeonato
 *  @var \App\Http\Entity\Estatistica[] $estatisticaList */
?>

<div class="row">
    <h2><?= $campeonato->nome ?> - <?= $campeonato->temporada ?></h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <?= $this->insert('components/buttons/button-link-voltar', [
            'rota' => '/', 
        ]) ?>
    </div>
</div>

<div class="row mt-3 justify-content-md-center">
    <div class="col-10">
    <?php if(!empty($estatisticaList)) : ?>

        <table class="table table-sm table-striped align-middle">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Equipe</th>
                    <th scope="col">J</th>
                    <th scope="col">V</th>
                    <th scope="col">E</th>
                    <th scope="col">D</th>
                    <th scope="col">Gols</th>
                    <th scope="col">Pts</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach($estatisticaList as $key => $estatistica): ?>
                    <tr>
                        <td><?= $key+1 ?></td>
                        <td><?= $estatistica->equipe->nome ?></td>
                        <td><?= $estatistica->jogos ?></td>
                        <td><?= $estatistica->vitorias ?></td>
                        <td><?= $estatistica->empates ?></td>
                        <td><?= $estatistica->derrotas ?></td>
                        <td>
                            <span data-bs-toggle="tooltip" data-bs-title="<?= $estatistica->saldoGols ?>">
                                <?= $estatistica->golsPro ?>:<?= $estatistica->golsContra ?>
                            </span>
                        </td>
                        <td><?= $estatistica->pontos ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-6 mb-3 mb-sm-0">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar equipes</h5>
                        <p class="card-text">Esse campeonato possui <?php $campeonato->numEquipes ?> equipes para serem inseridas</p>
                        <a href="#" class="btn btn-primary">Adicionar</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3 mb-sm-0">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Iniciar o Campeonato</h5>
                        <p class="card-text">Para iniciar o campeonato é necessário que as vagas dos times estejam preenchidas</p>
                        <a href="#" class="btn btn-primary">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>