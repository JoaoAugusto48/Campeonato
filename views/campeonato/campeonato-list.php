<?php
$this->layout('layout');
/** @var \App\Http\Entity\Campeonato[] $campeonatoList */
?>

<div class="row">
    <h2>Campeonatos</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <a href="/campeonatos/create" class="btn btn-info">Criar campeonato</a>
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
                    <th scope="col">Região</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach($campeonatoList as $key => $campeonato): ?>
                    <tr>
                        <td>
                            <?= $campeonato->nome ?>
                            <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-title="Número de Times">
                                <?= $campeonato->numEquipes ?>
                            </span>
                        </td>
                        <td><?= $campeonato->regiao ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
            