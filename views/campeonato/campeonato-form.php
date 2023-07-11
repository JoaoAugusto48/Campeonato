<?php
$this->layout('layout')
?>

<h2>Novo Campeonato</h2>
<hr class="border border-dark border-1 opacity-75"/>
<a href="/" class="btn btn-info">Voltar</a>

<?= $this->insert('components/messages/error-message') ?>

<div class="row justify-content-center">
    <div class="col-md-11 mt-2">
        <form method="POST">
            <div class="row"> 
                <div class="col-12 mb-3">
                    <label for="inputNome">Nome</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nome" 
                        id="inputNome" 
                        placeholder="ex: Brasileirão" 
                        autocomplete="off"
                    >
                </div>
                <div class="col-6 mb-3">
                    <label for="inputRegiao">Região</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="regiao" 
                        id="inputRegiao" 
                        placeholder="ex: Nacional" 
                        autocomplete="off"
                    >
                </div>
                <div class="col-3 mb-3">
                    <label for="inputTimes">Nº de equipes</label>
                    <input 
                        type="number"
                        class="form-control" 
                        name="equipes"
                        id="inputEquipes" 
                        placeholder="ex: 20"
                        min="2" 
                        autocomplete="off"
                    >
                </div>
                <div class="col-3 mb-3">
                    <label for="inputTurnos">Nº de Turnos</label>
                    <input 
                        type="number"
                        class="form-control" 
                        name="turnos" 
                        id="inputTurnos" 
                        placeholder="ex: 2"
                        min="1"
                        autocomplete="off"
                    >
                </div>
            </div>
            <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
    </div>
</div>