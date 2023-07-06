<?php 
$this->layout('layout');
/** @var \App\Http\Entity\Equipe|null $equipe */
/** @var \App\Http\Entity\Pais $paisList */

?>
<h2>Nova Equipe</h2>
<hr class="border border-dark border-1 opacity-75"/>
<a href="/equipes" class="btn btn-info">Voltar</a>

<?= $this->insert('components/messages/error-message') ?>

<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="POST">
            <div class="mb-3">
                <label for="inputNacionalidade">Nome</label>
                <input 
                    type="text" 
                    value="<?= $equipe?->nome; ?>"
                    class="form-control" 
                    name="nome" 
                    id="inputNacionalidade" 
                    placeholder="Nome do País" 
                    autocomplete="off"
                >
            </div>
            <div class="mb-3">
                <label for="inputSigla">Sigla</label>
                <input 
                    type="text"
                    value="<?= $equipe?->sigla; ?>" 
                    class="form-control" 
                    name="sigla" 
                    id="sigla" 
                    placeholder="Sigla do País" 
                    autocomplete="off"
                >
            </div>
            <div class="mb-3">
                <div class="form-group">
                  <label for="">País</label>
                  <select class="form-control" name="pais" id="" required>
                    <option value="" selected disabled>Selecione uma opção</option>
                    <?php foreach ($paisList as $key => $pais): ?>
                        <?php if($pais->id == $equipe->pais->id): ?>
                            <option value="<?= $pais->paisEncode() ?>" selected><?= $pais->paisShowSelect() ?></option>
                        <?php endif; ?>
                        <option value="<?= $pais->paisEncode() ?>"><?= $pais->paisShowSelect() ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
    </div>
</div>



