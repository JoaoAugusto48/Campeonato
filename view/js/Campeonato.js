function valida_campeonato(){

    //validar o nome do campeonato
    if (document.fcampeonato.txtNome.value.length==0){
       alert("Campo 'Nacionalidade' vazio");
       document.fcampeonato.txtNome.focus();
       return 0;
    }

    //validar quantidade de equipes
    if(document.fcampeonato.nEquipe.value<2){
        alert("É necessário colocar ao menos 2 equipes!");
        document.fcampeonato.nEquipe.focus();
        return 0;
    } else 
        if(document.fcampeonato.nEquipe.value>30 && document.fcampeonato.chkTurno.checked){
            alert("Não é possível criar Campeonato com mais de 30 times e com habilitação de 2 turno");
            document.fcampeonato.chkTurno.focus();
            return 0;
        } 

    //o formulário se envia
    //alert("Muito obrigado por enviar o formulário");
    document.fcampeonato.submit();
}
