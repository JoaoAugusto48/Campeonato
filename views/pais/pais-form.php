<?php
$this->layout('layout');
/** @var \App\Http\Entity\Pais|null $pais */
?>

<h2>Novo País</h2>
<hr class="border border-dark border-1 opacity-75"/>
<a href="/paises" class="btn btn-info">Voltar</a>

<?= $this->insert('components/messages/error-message') ?>

<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="POST">
            <div class="mb-3">
                <label for="inputNacionalidade">Nacionalidade</label>
                <input 
                    type="text" 
                    value="<?= $pais?->nome; ?>"
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
                    value="<?= $pais?->sigla; ?>" 
                    class="form-control" 
                    name="sigla" 
                    id="sigla" 
                    placeholder="Sigla do País" 
                    autocomplete="off"
                >
            </div>
            <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
    </div>
</div>
