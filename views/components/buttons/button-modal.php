<?php
    /**
     * @var string $classes
     * @var ?string $key
     * @var string $nome
     */
?>
<button 
    type="button" 
    class="btn btn-<?= $classes ?>" 
    data-bs-toggle="modal" 
    data-bs-target="#modal-<?= $key ?>"
>
    <?= $nome ?>
</button>
