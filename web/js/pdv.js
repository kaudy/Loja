$(document).ready(function(){
    
    $('#find-produto').submit(function(evento){
        evento.preventDefault();
       
       var url = $(this).attr('action');
       
       var dados = {
           produto: $(this).find('input[name="produto"]').val()
       };
       
       $.post(url, dados, function(retorno)
       {
           $('#produto, #alerta-produto').addClass('hide');
           
           if (retorno.nome != null)
           {
           
           $('#produto .nome').html(retorno.nome);
           $('#produto .marca').html(retorno.marca);
           $('#produto .preco').html(retorno.valor);
           $('#produto .modelo').html(retorno.modelo);
           $('#produto .imagem').attr('src', '/produtos/'+retorno.imagem);
           $('#produto').removeClass('hide');
           
           listagemItens();
           
          } else {
            $('#alerta-produto').removeClass('hide');  
          }
          
          $('input[name="produto"]').val('').focus();
          
       });
        
    });
    
    
    
});

function listagemItens()
{
    $.getJSON('/list-itens',function(retorno)
    {
        $('#lista-produtos .listagem').empty();
        var total = 0;
        for(idx in retorno)
        {
           var produto = retorno[idx];
           
           var li = $('<li>Produto '+produto.codigo+' <span class="pull-right">R$ '+produto.valor+'</span></li>')
           $('#lista-produtos .listagem').append(li);
           
           total +=parseFloat(produto.valor);
        }
        
        $('.total-pagar').html('R$ '+total.toFixed(2));
    });
}
