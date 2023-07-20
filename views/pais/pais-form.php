<?php
$this->layout('layout');
/** @var \App\Http\Entity\Pais|null $pais */
?>

<div class="row">
    <h2>Novo País</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col">
        <?= $this->insert('components/buttons/button-link-voltar', ['rota' => '/paises']) ?>
    </div>
</div>

<?= $this->insert('components/messages/error-message') ?>

<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="POST">
            <?= $this->insert('components/inputs/input-pattern', [
                'descricao' => 'Nacionalidade',
                'type' => 'text',
                'name' => 'nome',
                'dica' => 'ex: Brasil',
                'value' => $pais?->nome,
                'autocomplete' => null,
                'classes' => null,
                'required' => true,
            ]) ?>
            <?= $this->insert('components/inputs/input-pattern', [
                'descricao' => 'Sigla',
                'type' => 'text',
                'name' => 'sigla',
                'dica' => 'ex: BRA',
                'value' => $pais?->sigla,
                'autocomplete' => null,
                'classes' => null,
                'required' => true,
            ]) ?>
            <?= $this->insert('components/buttons/button-submit') ?>
        </form>
    </div>
</div>
