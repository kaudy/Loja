
$(document).ready(function ()
{
    $('#find-produto').submit( function(evento)
    {
        evento.preventDefault();
        var url = $(this).attr('action');
        
        var dados = {
          produto: $(this).find('input[name="produto"]').val()  
        };        
        
        $.post(url,dados, function(retorno)
        {
            $('#produto, #alerta-produto').addClass('hide');
            if(retorno.nome !=null)
            {
                $('.nome').html(retorno.nome);
                $('.preco').html(retorno.valor);
                $('.marca').html(retorno.marca);
                $('.tamanho').html(retorno.tamanho);
                $('.modelo').html(retorno.modelo);
                $('#produto').removeClass('hide');
            }else
            {
                $('#alerta-produto').removeClass('hide');
                $('#produto').addClass('hide');
                $('input[name="produto"]').val('').focus();
            }
        });        
    });
    
});
