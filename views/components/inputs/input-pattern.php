<?php 
    /**
     * @var string $descricao
     * @var string $type
     * @var string $name
     * @var ?string $value
     * @var ?string $dica
     * @var ?string $autocomplete
     * @var ?string $classes
     * @var ?boolean $required
     */
?>
<div class="mb-3">
    <label for="input<?= $descricao ?>"><?= $descricao ?></label>
    <input 
        type="<?= $type ?>" 
        value="<?= $value ?>"
        class="form-control <?= $classes ?>" 
        name="<?= $name ?>" 
        id="input<?= $descricao ?>" 
        placeholder="<?= $dica ?>" 
        autocomplete="<?= is_null($autocomplete) ? 'off' : $autocomplete ?>"
        required="<?= (is_null($required) || !$required) ? 'false' : 'true' ?>"
    >
</div>