<?php 
$this->layout('layout');
/** @var \App\Http\Entity\Equipe[] $equipeList */
?>
<div class="row">
    <h2>Equipes</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <?= $this->insert('components/buttons/button-link-voltar', ['rota' => '/']) ?>
        <?= $this->insert('components/buttons/button-link-pattern', [
            'rota' => '/equipes/create',
            'nome' => 'Inserir Equipe'
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
                    <th scope="col">Sigla</th>
                    <th scope="col">Nome</th>
                    <th scope="col">País</th>
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach($equipeList as $key => $equipe): ?>
                    <tr>
                        <td><?= $equipe->sigla ?></td>
                        <td><?= $equipe->nome ?></td>
                        <td><?= $equipe->pais->nome ?></td>
                        <td>
                            <a type="button" href="/equipes/edit?id=<?= $equipe->id ?>" class="btn btn-warning btn-sm">Editar</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-<?= $key ?>">Remover</button>
                            <?= $this->insert('/components/modals/modal-delete-form', [
                                'action' => '/equipes/delete',
                                'key' => $key,
                                'object' => 'Equipe',
                                'name' => $equipe->nome,
                                'id' => $equipe->id 
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>