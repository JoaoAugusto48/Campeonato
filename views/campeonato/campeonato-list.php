<?php
$this->layout('layout');
/** @var \App\Http\Entity\Campeonato[] $campeonatoList */
?>

<div class="row">
    <h2>Campeonatos</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <?= $this->insert('components/buttons/button-link-pattern', [
            'rota' => '/campeonatos/create', 
            'nome' => 'Criar campeonato'
        ]) ?>
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
                    <th scope="col">Temporada</th>
                    <th scope="col">Região</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach($campeonatoList as $key => $campeonato): ?>
                    <tr>
                        <td>
                            <a href="/campeonatos/show?id=<?= $campeonato->id ?>" 
                                class="link-dark 
                                        link-underline-primary 
                                        link-offset-2 link-underline-opacity-50 
                                        link-opacity-75-hover 
                                        link-underline-opacity-100-hover" 
                            ><?= $campeonato->nome ?></a>
                            <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-title="Número de Times">
                                <?= $campeonato->numEquipes ?>
                            </span>
                        </td>
                        <td><?= $campeonato->temporada ?></td>
                        <td><?= $campeonato->regiao ?></td>
                        <td>
                            <?= $this->insert('components/buttons/button-link', [
                                'rota' => '/campeonatos/edit?id=' . $campeonato->id,
                                'classes' => 'warning btn-sm',
                                'nome' => 'Editar'
                            ]) ?>

                            <?= $this->insert('components/buttons/button-modal', [
                                'classes' => 'danger btn-sm',
                                'key' => $key,
                                'nome' => 'Remover'
                            ]) ?>
                            
                            <?= $this->insert('/components/modals/modal-delete-form', [
                                'action' => '/campeonatos/delete',
                                'key' => $key,
                                'object' => 'Campeonato',
                                'name' => $campeonato->nome,
                                'id' => $campeonato->id 
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
            