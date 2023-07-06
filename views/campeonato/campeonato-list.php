<?php
$this->layout('layout')
?>

<div class="row">
    <h2>Campeonatos</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <a href="/campeontato/create" class="btn btn-info">Criar campeonato</a>
    </div>
</div>

<?= $this->insert('components/messages/success-message') ?>
<?= $this->insert('components/messages/error-message') ?>

<div class="row mt-3 justify-content-md-center">
    <div class="col-10">
        <table class="table table-sm table-striped align-middle">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Nº Equipes</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach($campeonatoList as $key => $campeonato): ?>
                    <tr>
                        <td><?= $campeonato->nome ?></td>
                        <td><?= $campeonato->qtdeEquipe ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
            