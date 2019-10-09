function valida_pais(){

    //valido o nome do pais
    if (document.fvalida.txtNome.value.length==0){
       alert("Campo 'Nacionalidade' vazio");
       document.fvalida.txtNome.focus();
       return 0;
    }

    //o formulário se envia
    //alert("Muito obrigado por enviar o formulário");
    document.fvalida.submit();
}
