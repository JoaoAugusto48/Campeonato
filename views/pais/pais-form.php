<?php
$this->layout('layout');
/** @var \App\Http\Entity\Pais|null $pais */
?>

<h2>Cadastrar novo País</h2>
<hr class="bg-dark" />
<a href="/paises" class="btn btn-info">Voltar</a>
<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="POST">
            <div class="form-group row">
                <label for="lblNome" class="col-md-2 col-form-label text-right">Nacionalidade</label>
                <div class="col-md-10">
                    <input 
                        type="text" 
                        value="<?= $pais?->nome; ?>"
                        class="form-control" 
                        name="nome" 
                        id="nome" 
                        placeholder="Nome do País" 
                        autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="lblNome" class="col-md-2 col-form-label text-right">Sigla</label>
                <div class="col-md-10">
                    <input 
                        type="text"
                        value="<?= $pais?->sigla; ?>" 
                        class="form-control" 
                        name="sigla" 
                        id="sigla" 
                        placeholder="Sigla do País" 
                        autocomplete="off">
                </div>
            </div>
            <div class="form-group offset-md-2">
                <button type="submit" class="center-block btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>
</div>
