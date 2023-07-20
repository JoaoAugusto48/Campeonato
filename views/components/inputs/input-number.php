<?php 
    /**
     * @var string $descricao
     * @var string $name
     * @var ?string $value
     * @var ?string $dica
     * @var ?string $classes
     * @var ?boolean $required
     * @var ?int $valorMin
     * @var ?int $valorMax
     * @var ?boolean $desabilitado
     */
?>
<div class="mb-3">
    <label for="input<?= $descricao ?>"><?= $descricao ?></label>
    <input 
        type="number" 
        id="input<?= $descricao ?>" 
        name="<?= $name ?>" 
        value="<?= $value ?>"
        class="form-control <?= $classes ?>" 
        placeholder="<?= $dica ?>" 
        required="<?= (is_null($required) || !$required) ? 'false' : 'true' ?>"
        min="<?= $valorMin ?>"
        max="<?= $valorMax ?>"
    >
</div>