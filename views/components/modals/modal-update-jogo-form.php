<?php 
    /**
     * @var string $action
     * @var ?string $key
     * @var int $rodada
     * @var int $partidaId
     * @var \App\Http\DTO\EquipePartidaDTO $timeCasa
     * @var \App\Http\DTO\EquipePartidaDTO $timeFora
     */
?>
<div class="modal fade" tabindex="-1" id="modal-<?= $key ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rodada <?= $rodada ?> - <?= $timeCasa->nome ?> x <?= $timeFora->nome ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/partidas/edit" method="post">
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 text-start">
                                <?= $this->insert('components/inputs/input-number', [
                                        'descricao' => 'casa: ' .$timeCasa->nome,
                                        'name' => 'golsCasa',
                                        'value' => $timeCasa->gols,
                                        'dica' => 'número de gols',
                                    ]) 
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-start">
                                <?= $this->insert('components/inputs/input-number', [
                                        'descricao' => 'fora: ' . $timeFora->nome,
                                        'name' => 'golsFora',
                                        'value' => $timeFora->gols,
                                        'dica' => 'número de gols',
                                    ]) 
                                ?>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?= $partidaId ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modal<?= $key ?>">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
