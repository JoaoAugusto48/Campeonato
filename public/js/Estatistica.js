var d = document;
function $( bloco )
{
    return d.getElementById( bloco );
}

function getItensSel(itens)
{
    
    var oElementos = d.getElementsByTagName('input');
    for( var i = 0; i < oElementos.length; i++ )
    {
        if( oElementos[ i ].type == 'checkbox' )
        {
           if( oElementos[ i ].checked )
           {
              itens--;
           }
        }
    }   
    $( 'total' ).innerHTML = itens;
}

function valida_estatistica(){

    var nTimes = $( 'total' ).innerHTML;

    //valido o nome do pais
    if (nTimes != 0){
       alert("É necessário adicionar mais "+ nTimes +" times");
       document.fvalida.chkId.focus();
       return 0;
    }

    //o formulário se envia
    //alert("Muito obrigado por enviar o formulário");
    document.fvalida.submit();
}