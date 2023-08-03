<?php 
    /**
     * @var string $descricao
     * @var string $name
     * @var ?string $value
     * @var ?string $dica
     * @var ?string $autocomplete
     * @var ?string $classes
     * @var ?boolean $required
     */
?>
<div class="mb-3">
    <label for="input<?= $descricao ?>"><?= $descricao ?><?= (!is_null($required) || $required) ? ' *' : ''?></label>
    <input 
        type="text" 
        id="input<?= $descricao ?>" 
        name="<?= $name ?>" 
        value="<?= $value ?>"
        class="form-control <?= $classes ?>" 
        placeholder="<?= $dica ?>" 
        autocomplete="<?= is_null($autocomplete) ? 'off' : $autocomplete ?>"
        required="<?= (is_null($required) || !$required) ? 'false' : 'true' ?>"
    >
</div>