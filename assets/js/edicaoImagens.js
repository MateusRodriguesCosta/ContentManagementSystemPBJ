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
    var origin = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var user = $('#usuario').text();
    jsondata = JSON.stringify(reader.result);
    $.ajax(origin + '/assets/tmp/temporario.php', {
      method: "POST",
      data: {'original' : jsondata, 'user' : user},
      cache: false,
      success: function(output) {
        console.log('Upload success (default)');
        $('#display').html(output);
      },
      error: function () {
        console.log('Upload error (default)');
      }
      });
    }
  }
}
