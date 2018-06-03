$(function(){
  /*Impedindo que a pagina atualize*/
  $('body').on('submit','form', function() {
    //Enviando os dados do form via json
    var form = $(this);
      $.ajax({
        beforeSend: function(){
          //Mostrando o icone de enviando e impedindo que o form seja alterado
          //Equanto os dados não forem enviados
          $('.overlayLoading').fadeIn();
        },
        url: include_path+'ajax/formularios.php',
        method: 'post',
        dataType: 'json',
        data: form.serialize()
      }).done(function(data){
        if(data.sucesso) {
          $('.overlayLoading').fadeOut();
          $('.sucesso').fadeIn();
          //Limpando todos os inputs após o envio
          $(":input").val("");
          setTimeout(function(){
            $('.sucesso').fadeOut();
          },3000);
        }else {
          $('.overlayLoading').fadeOut();
          $('.erroEnvio').fadeIn();
          setTimeout(function(){
            $('.erroEnvio').fadeOut();
          },3000);
        }

      });
      return false;
  })
});
