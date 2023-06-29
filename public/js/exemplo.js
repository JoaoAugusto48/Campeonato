function valida_envia(){
    //valido o nome
    if (document.fvalida.nome.value.length==0){
       alert("Tem que escrever seu nome")
       document.fvalida.nome.focus()
       return 0;
    }

    //valido a idade. Tem que ser inteiro maior que 18
    edad = document.fvalida.idade.value
    edad = validarInteiro(idade)
    document.fvalida.idade.value=idade
    if (idade==""){
       alert("Tem que introduzir um número inteiro em sua idade.")
       document.fvalida.idade.focus()
       return 0;
    }else{
       if (idade<18){
          alert("Deve ser maior de 18 anos.")
          document.fvalida.idade.focus()
          return 0;
       }
    }

    //valido o interesse
    if (document.fvalida.interesse.selectedIndex==0){
       alert("Deve selecionar um motivo de seu contato.")
       document.fvalida.interesse.focus()
       return 0;
    }

    //o formulário se envia
    alert("Muito obrigado por enviar o formulário");
    document.fvalida.submit();
}