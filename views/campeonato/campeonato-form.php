<?php
$this->layout('layout');
/** @var \App\Http\Entity\Campeonato|null $campeonato */
?>

<div class="row">
    <h2>Novo Campeonato</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <?= $this->insert('components/buttons/button-link-voltar', ['rota' => '/']) ?>
    </div>
</div>

<?= $this->insert('components/messages/error-message') ?>

<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="POST">
            <div class="row"> 
                <div class="col-9">
                    <?= $this->insert('components/inputs/input-text', [
                        'descricao' => 'Nome',
                        'name' => 'nome',
                        'value' => $campeonato?->nome,
                        'dica' => 'ex: Brasileirão',
                        'autocomplete' => 'off',
                        'classes' => null,
                        'required' => true,
                    ]) ?>
                </div>
                <div class="col-3">
                    <?= $this->insert('components/inputs/input-text', [
                        'descricao' => 'Temporada',
                        'name' => 'temporada',
                        'value' => is_null($campeonato?->temporada) ? date('Y') : $campeonato->temporada,
                        'dica' => 'ex: 2012',
                        'autocomplete' => 'off',
                        'classes' => null,
                        'required' => true,
                    ]) ?>
                    
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="inputRegiao">Região</label>
                        <select class="form-control" name="regiao" id="inputRegiao" required>
                            <option selected disabled value="">Selecione uma opção</option>
                            <?php foreach($regiaoList as $regiao) : ?>
                                <option <?= ($regiao->name === $campeonato?->regiao) ? 'selected' : '' ?>>
                                    <?= $regiao->name ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <?= $this->insert('components/inputs/input-number', [
                        'descricao' => 'Nº de equipes',
                        'name' => 'equipes',
                        'value' => $campeonato?->numEquipes,
                        'dica' => 'ex: 20',
                        'classes' => null,
                        'required' => true,
                        'valorMin' => 2,
                        'valorMax' => 1000,
                    ]) ?>
                </div>
                <div class="col-3">
                    <?= $this->insert('components/inputs/input-number', [
                        'descricao' => 'Nº de turnos',
                        'name' => 'turnos',
                        'value' => $campeonato?->numTurnos,
                        'dica' => 'ex: 2',
                        'classes' => null,
                        'required' => true,
                        'valorMin' => 1,
                        'valorMax' => 10,
                    ]) ?>
                </div>
            </div>
            <?= $this->insert('components/buttons/button-submit') ?>
        </form>
    </div>
</div>