/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

(function($) {

  $(document).ready(function() {
    "use strict";

    // Inicializa Theme Core
    Core.init();

    // Inicializa Demo JS
    Demo.init();

    var console = window.console || {
      log: function() {}
    },
    $alert = $('.docs-alert'),
    $message = $alert.find('.message'),
    showMessage = function(message, type) {
      $message.text(message);

      if (type) {
        $message.addClass(type);
      }

      $alert.fadeIn();
      setTimeout(function() {
        $alert.fadeOut();
      }, 3000);
    };

    // Cropper configuração
    (function() {
      var $image  = $('.img-container > img'),
      $dataX      = $('#dataX'),
      $dataY      = $('#dataY'),
      $dataHeight = $('#dataHeight'),
      $dataWidth  = $('#dataWidth'),
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

      $image.cropper(options);

      $(document.body).on('click', '[data-method]', function() {
        var data = $(this).data(),
        $target,
        result;

        if (data.method) {
          data = $.extend({}, data);

          if (typeof data.target !== 'undefined') {
            $target = $(data.target);

            if (typeof data.option === 'undefined') {
              try {
                data.option = JSON.parse($target.val());
              } catch (e) {
                console.log(e.message);
              }
            }
          }

          result = $image.cropper(data.method, data.option);

          // Método getCroppedCanvas alterado para se adaptar
          // às necessidades do site da Pousada. Alterações
          // realizadas em 01/06/2017 por:
          // Mateus Costa mateusespindola25@hotmail.com

          if (data.method === 'getCroppedCanvas') {
            var verificaRecorte = 'true';
            if(result.length == '1'){
              verificaRecorte = 'false';
            }
            $('#verificacao').val(verificaRecorte);
            if(verificaRecorte == 'true'){result.toBlob(function(blob){
              var reader = new FileReader();
              reader.readAsDataURL(blob);
              var user = $('#usuario').text();
              var recorte;

              reader.onloadend = function() {
                recorte = reader.result;
                enviarImagem(recorte, user);
              }

            });}
          }

          if ($.isPlainObject(result) && $target) {
            try {
              $target.val(JSON.stringify(result));
            } catch (e) {
              console.log(e.message);
            }
          }
        }
      });

      // Importar imagem
      var $inputImage = $('#inputImage'),
      URL = window.URL || window.webkitURL,
      blobURL;

      if (URL) {
        $inputImage.change(function() {
          var files = this.files,
          file;

          if (files && files.length) {
            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
              blobURL = URL.createObjectURL(file);
              $image.one('built.cropper', function() {
                URL.revokeObjectURL(blobURL);
              }).cropper('reset', true).cropper('replace', blobURL);
              $inputImage.val('');
            } else {
              showMessage('Please choose an image file.');
            }
          }
        });
      } else {
        $inputImage.parent().remove();
      }

      // Opções
      $('.docs-options :checkbox').on('change', function() {
        var $this = $(this);
        options[$this.val()] = $this.prop('checked');
        $image.cropper('destroy').cropper(options);
      });
    }());
  });
})(jQuery);
