<?php
$this->layout('layout');
/** @var \App\Http\Entity\Pais[] $paisList */
?>

<div class="row">
    <h2>Países</h2>
    <hr class="border border-dark border-1 opacity-75"/>
    
    <div class="col-lg-3">
        <a href="/" class="btn btn-info">Voltar</a>
        <a href="/paises/create" class="btn btn-info">Inserir País</a>
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
                    <th scope="col">Operações</th>
                </tr>
            </thead>
            <tbody class="">
                <?php foreach ($paisList as $key => $pais): ?>
                    <tr>
                        <td><?= $pais->sigla ?></td>
                        <td><?= $pais->nome ?></td>
                        <td>
                            <a type="button" href="/paises/edit?id=<?= $pais->id ?>" class="btn btn-warning btn-sm">Editar</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-<?= $key ?>">Remover</button>
                            <?= $this->insert('/components/modals/modal-delete-form', [
                                'action' => '/paises/delete',
                                'key' => $key,
                                'object' => 'País',
                                'name' => $pais->nome,
                                'id' => $pais->id 
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>