jQuery(document).ready(function(){
  $(window).on('load', function() {
    $('#preloader').addClass('zoomOut');
    var imagemURL = $('#imagemContainer').prop('src');
    if (imagemURL) {
      var datamodificacao;
      var resposta;
      var repetir = 0;
      var intervalo = setInterval(function() {
        var xhr = $.ajax({
          url: imagemURL.split('?')[0],
          cache: false,
          success: function(response) {
            resposta = new Date(xhr.getResponseHeader("Last-Modified"));
            resposta = resposta.toUTCString();
            if(datamodificacao == null){datamodificacao = resposta;}
            else{
              if(datamodificacao < resposta) {
                var $image = $('.img-container > img'),
                $dataX = $('#dataX'),
                $dataY = $('#dataY'),
                $dataHeight = $('#dataHeight'),
                $dataWidth = $('#dataWidth'),
                $dataRotate = $('#dataRotate'),
                options = {
                  preview: '.img-preview',
                  crop: function(data) {
                    $dataX.val(Math.round(data.x));
                    $dataY.val(Math.round(data.y));
                    $dataHeight.val(Math.round(data.height));
                    $dataWidth.val(Math.round(data.width));
                    $dataRotate.val(Math.round(data.rotate));
                  }
                };
                $image.cropper('destroy');
                $("#imagemContainer").hide('fade', function(){
                  document.getElementById("imagemContainer").src = imagemURL;
                  $image.cropper(options);
                });
                clearInterval(intervalo);
              } else if (datamodificacao == resposta) {
                if(repetir == 2) {
                  clearInterval(intervalo);
                } else {repetir++;}
              }
            }
          }
        });
      }, 8500);
    }
  });
});
