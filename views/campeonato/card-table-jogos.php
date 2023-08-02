<?php
/** @var \App\Http\Entity\Campeonato $campeonato
 *  @var \App\Http\DTO\RodadaDTO[] $partidasMap
 * */
?>
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link disabled">Rodadas</a>
            </li>
            <?php foreach($partidasMap as $rodada => $partida): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($rodada === $campeonato->rodadaAtual)? 'active' : '' ?> nav-rounds" onclick="showNav(this, <?= $rodada ?>)" ><?= $rodada ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php foreach($partidasMap as $rodada => $partidas): ?>
    <div class="<?= $rodada !== $campeonato->rodadaAtual ? 'd-none' : 'd-inline' ?> games-list" id="<?= $rodada ?>">
        <div class="card-body">
            
            <table class="table table-hover table-borderless card-text">
                <tr>
                    <td colspan="5">Rodada <?= $rodada ?></td>
                </tr>
                <?php foreach($partidas as $key => $equipe): ?>
                <tr class="align-middle">
                    <form action="" method="post">
                        <td class="text-end"><?= $equipe->equipeCasa->nome ?></td>
                        <td class="text-end"><?= $equipe->equipeCasa->gols ?></td>
                        <td class="text-center">x</td>
                        <td class="text-start"><?= $equipe->equipeVisitante->gols ?></td>
                        <td class="text-start"><?= $equipe->equipeVisitante->nome ?></td>
                        <td class="text-end">
                            <?= $this->insert('components/buttons/button-modal', 
                                [
                                    'classes' => 'info btn-sm',
                                    'key' => $rodada . $key,
                                    'nome' => 'Atualizar'
                                ]);
                            ?>   
                        </td>
                    </form>
                </tr>
                <?= $this->insert('components/modals/modal-update-jogo-form', 
                    [
                        'action' => '',
                        'key' => $rodada . $key,
                        'rodada' => $rodada,
                        'partidaId' => $equipe->partidaId,
                        'timeCasa' => $equipe->equipeCasa,
                        'timeFora' => $equipe->equipeVisitante,
                    ]) 
                ?>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="card-footer">
            <small class="text-body-secondary">Rodada <?= $rodada ?></small>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
    
    let navRounds = document.getElementsByClassName("nav-rounds");
    let gamesList = document.getElementsByClassName("games-list");

    function showNav(element, rodada) {
        let jogosList = document.getElementById(rodada);

        for(let i=0; i<navRounds.length; i++){
            if(navRounds[i].classList.contains('active')){
                navRounds[i].classList.remove('active');
            }
        }
        element.classList.add('active');

        for(let i=0; i<gamesList.length; i++){
            
            if(gamesList[i].classList.contains('d-inline')){
                gamesList[i].classList.replace('d-inline', 'd-none');
            } 
            else if(!gamesList[i].classList.contains('d-none')){
                gamesList[i].classList.replace('d-none', 'd-inline');
            }
        }
        jogosList.classList.remove('d-none');
        jogosList.classList.add('d-inline');
        
    }

</script>