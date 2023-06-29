<?php
$this->layout('layout');
/** @var \App\Http\Entity\Pais[] $paisList */
?>

<h2>Lista de Paises</h2>
<hr class="bg-dark" />
<a href="" class="btn btn-info">Voltar</a>
<a href="/paises/create" class="btn btn-info">Inserir País</a>
<br><br>
<table class="table table-striped text-center">
    <thead class="thead-dark">
        <tr>
            <th>Sigla</th>
            <th>Nome</th>
            <th>Operações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($paisList as $pais): ?>
            <tr>
                <td><?= $pais->sigla ?></td>
                <td><?= $pais->nome ?></td>
                <td>
                    <form action="/paises/delete" method="post">
                        <a type="button" href="/paises/edit?id=<?= $pais->id ?>" class="btn btn-warning">Editar</a>
                        <input type="hidden" name="id" value="<?= $pais->id ?>">
                        <button type="submit" class="btn btn-danger">Remover</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>