<?php 
    /**
     * @var string $action
     * @var ?string $key
     * @var string $object
     * @var string $name
     * @var int $id
     */
?>
<div class="modal fade" tabindex="-1" id="modal-<?= $key ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?= $object ?> - <?= $name ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Você realmente deseja remover o item - <?= $name ?>?</p>
        </div>
        <div class="modal-footer">
            <form action="<?= $action ?>" method="post">
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $key ?>">Salvar</button>
            </form>
        </div>
        </div>
    </div>
</div>
