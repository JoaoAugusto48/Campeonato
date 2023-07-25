<?php 
$this->layout('layout');
/** @var \App\Http\Entity\Equipe|null $equipe */
/** @var \App\Http\Entity\Pais $paisList */
?>
<div class="row">
    <h2>Nova Equipe</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <?= $this->insert('components/buttons/button-link-voltar', ['rota' => '/equipes']) ?>
    </div>
</div>

<?= $this->insert('components/messages/error-message') ?>

<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="POST">
            <?= $this->insert('components/inputs/input-pattern', [
                'descricao' => 'Nome',
                'type' => 'text',
                'name' => 'nome',
                'dica' => 'ex: Juventude',
                'value' => $equipe?->nome,
                'autocomplete' => null,
                'classes' => null,
                'required' => true,
            ]) ?>
            <?= $this->insert('components/inputs/input-pattern', [
                'descricao' => 'Sigla',
                'type' => 'text',
                'name' => 'sigla',
                'dica' => 'ex: JUV',
                'value' => $equipe?->sigla,
                'autocomplete' => null,
                'classes' => null,
                'required' => true,
            ]) ?>
            
            <div class="mb-3">
                <div class="form-group">
                  <label for="selectPais">País</label>
                  <select class="form-control" name="pais" id="selectPais" required>
                    <option value="" selected disabled>Selecione uma opção</option>
                    <?php foreach ($paisList as $key => $pais): ?>
                        <?php if($pais->id === $equipe?->pais->id): ?>
                            <option value="<?= $pais->id ?>" selected><?= $pais ?></option>
                        <?php endif; ?>
                        <option value="<?= $pais->id ?>"><?= $pais ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <?= $this->insert('components/buttons/button-submit'); ?>
        </form>
    </div>
</div>



