function valida_equipe(){

    //valido o nome do pais
    if (document.fequipe.txtNome.value.length==0){
       alert("Campo 'Equipe' vazio");
       document.fequipe.txtNome.focus();
        return 0;
    }

    if (document.fequipe.txtSigla.value.length<2){
        alert("Campo 'Sigla' com caracteres insuficientes");
        document.fequipe.txtSigla.focus();
        return 0;
    }

    //o formulário se envia
    //alert("Muito obrigado por enviar o formulário");
    document.fequipe.submit();
}