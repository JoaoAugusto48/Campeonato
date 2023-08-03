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
    <label for="input<?= $descricao ?>"><?= $descricao ?><?= (!is_null($required) || $required) ? ' *' : ''?></label>
    <input 
        type="number" 
        id="input<?= str_replace(' ', '_', $descricao) ?>" 
        name="<?= $name ?>" 
        value="<?= isset($value) ? $value : 0 ?>"
        class="form-control <?= isset($classes) ? $classes : '' ?>" 
        placeholder="<?= isset($dica) ? $dica : '' ?>" 
        required="<?= (is_null($required) || !$required) ? 'false' : 'true' ?>"
        min="<?= isset($valorMin) ? $valorMin : 0 ?>"
        max="<?= isset($valorMax) ? $valorMax : 1000 ?>"
    >
</div>