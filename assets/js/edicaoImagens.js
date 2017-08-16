/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

function readURL(input,user) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.readAsDataURL(input.files[0]);
    reader.onloadend = function() {
      var getUrl = window.location;
      var origin = getUrl.protocol + "//" + getUrl.host;
      var user = $('#usuario').text();
      jsondata = JSON.stringify(reader.result);
      $.ajax(origin + '/assets/tmp/temporario.php', {
        method: "POST",
        data: {'original' : jsondata, 'user' : user, 'upload' : 'envio'},
        cache: false,
        success: function(output) {
          console.log('Upload success (default)');
        },
        error: function () {
          console.log('Upload error (default)');
        }
      });
    }
  }
}

function enviarImagem(imagem, usuario){
    var getUrl = window.location;
    var origin = getUrl.protocol + "//" + getUrl.host;
    var arrayString = dividirString(imagem, 800000);
    var numeroArquivos = Math.ceil(imagem.length / 800000);

    for (var variable in arrayString) {
      if (arrayString.hasOwnProperty(variable)) {
        $.ajax(origin + '/assets/tmp/temporario.php', {
          method: "POST",
          data: {'numeroArquivos' : numeroArquivos, 'ordemAJAX' : variable, 'user' : usuario, 'recorte' : JSON.stringify(arrayString[variable])},
          cache: false,
          success: function(output) {
            console.log('Upload success (cropped)');
          },
          error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
              msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
              msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
              msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
              msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
              msg = 'Time out error.';
            } else if (exception === 'abort') {
              msg = 'Ajax request aborted.';
            } else {
              msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log('Upload error (cropped) '+msg);
          }
        });
      }
    }
}

function dividirString(string, tamanho) {
  var numeroDivisoes = Math.ceil(string.length / tamanho),
      divisoes = new Array(numeroDivisoes);

  for(var i = 0, o = 0; i < numeroDivisoes; ++i, o += tamanho) {
    divisoes[i] = string.substr(o, tamanho);
  }

  return divisoes;
}
