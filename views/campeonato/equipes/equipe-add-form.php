<?php 
$this->layout('layout');
/** @var \App\Http\Entity\Campeonato $campeonato
 *  @var string $lastUrl
 *  @var \App\Http\Entity\Equipe[] $equipeList
 */
?>
<div class="row">
    <h2>Adicionar equipes - <?= $campeonato->nome ?></h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <?= $this->insert('components/buttons/button-link-voltar', [
            'rota' => $lastUrl, 
        ]) ?>
    </div>
</div>

<?= $this->insert('components/messages/success-message') ?>
<?= $this->insert('components/messages/error-message') ?>

<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="post">
            <div class="row">
                <p>Equipes adicionadas: <span id="selectedValues">0</span> de <?= $campeonato->numEquipes ?></p>

                <?php foreach($equipeList as $key => $equipe): ?>
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input check" type="checkbox" value="<?= $equipe->id ?>" id="equipe-<?= $key ?>">
                            <label class="form-check-label" for="equipe-<?= $key ?>">
                                <?= $equipe->nome ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?= $this->insert('components/buttons/button-submit')  ?>

        </form>
    </div>
</div>

<script>
    let selectedValues = document.getElementById('selectedValues');

    console.log(selectedValues.textContent);
</script>