<?php
$this->layout('layout');
/** @var \App\Http\Entity\Campeonato $campeonato
 *  @var \App\Http\Entity\Estatistica[] $estatisticaList 
 *  @var \App\Http\DTO\RodadaDTO[] $partidasMap
 * */
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

<?= $this->insert('components/messages/success-message') ?>
<?= $this->insert('components/messages/error-message') ?>

<div class="row mt-3 justify-content-md-center">
    <div class="col-10">
    <?php if(!empty($estatisticaList)) : ?>

        <table class="table table-sm table-striped align-middle">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Equipe</th>
                    <th class="text-center" scope="col">J</th>
                    <th class="text-center" scope="col">V</th>
                    <th class="text-center" scope="col">E</th>
                    <th class="text-center" scope="col">D</th>
                    <th class="text-center" scope="col">Gols</th>
                    <th class="text-center" scope="col">SG</th>
                    <th class="text-center" scope="col">Pts</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach($estatisticaList as $key => $estatistica): ?>
                    <tr>
                        <td class="text-center"><?= $key+1 ?></td>
                        <td class="text-start"><?= $estatistica->equipe->nome ?></td>
                        <td class="text-center"><?= $estatistica->jogos ?></td>
                        <td class="text-center"><?= $estatistica->vitorias ?></td>
                        <td class="text-center"><?= $estatistica->empates ?></td>
                        <td class="text-center"><?= $estatistica->derrotas ?></td>
                        <td class="text-center">
                            <span data-bs-toggle="tooltip" data-bs-title="<?= $estatistica->saldoGols ?>">
                                <?= $estatistica->golsPro ?>:<?= $estatistica->golsContra ?>
                            </span>
                        </td>
                        <td class="text-center"><?= $estatistica->saldoGols ?></td>
                        <td class="text-center"><?= $estatistica->pontos ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?= $this->insert('campeonato/card-table-jogos', ['campeonato' => $campeonato, 'partidasMap' => $partidasMap]); ?>

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
