/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

'use strict';
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
            var $image = $('.img-container > img'),
                $dataX = $('#dataX'),
                $dataY = $('#dataY'),
                $dataHeight = $('#dataHeight'),
                $dataWidth = $('#dataWidth'),
                $dataRotate = $('#dataRotate'),
                options = {
                  //  aspectRatio: 16 / 9, (optional)
                    preview: '.img-preview',
                    crop: function(data) {
                        $dataX.val(Math.round(data.x));
                        $dataY.val(Math.round(data.y));
                        $dataHeight.val(Math.round(data.height));
                        $dataWidth.val(Math.round(data.width));
                        $dataRotate.val(Math.round(data.rotate));
                    }
                };

            $image.on({
                'build.cropper': function(e) {
                    console.log(e.type);
                },
                'built.cropper': function(e) {
                    console.log(e.type);
                },
                'dragstart.cropper': function(e) {
                    console.log(e.type, e.dragType);
                },
                'dragmove.cropper': function(e) {
                    console.log(e.type, e.dragType);
                },
                'dragend.cropper': function(e) {
                    console.log(e.type, e.dragType);
                },
                'zoomin.cropper': function(e) {
                    console.log(e.type);
                },
                'zoomout.cropper': function(e) {
                    console.log(e.type);
                }
            }).cropper(options);

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
                          var reader = new window.FileReader();
                          reader.readAsDataURL(blob);
                          reader.onloadend = function() {
                            // Conversão do resultado para String JSON.
                            var getUrl = window.location;
                            var origin = getUrl.protocol + "//" + getUrl.host;
                            var user = $('#usuario').text();
                            var jsonData = JSON.stringify(reader.result);
                            $.ajax(origin + '/assets/tmp/temporario.php', {
                              method: "POST",
                              data: {'recorte' : jsonData, 'user' : user},
                              cache: false,
                              success: function (output) {
                                console.log('Upload success (cropped)');
                              },
                              error: function () {
                                console.log('Upload error (cropped)');
                              }
                            });
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
            }).on('keydown', function(e) {
                switch (e.which) {
                    case 37:
                        e.preventDefault();
                        $image.cropper('move', -1, 0);
                        break;

                    case 38:
                        e.preventDefault();
                        $image.cropper('move', 0, -1);
                        break;

                    case 39:
                        e.preventDefault();
                        $image.cropper('move', 1, 0);
                        break;

                    case 40:
                        e.preventDefault();
                        $image.cropper('move', 0, 1);
                        break;
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

            // Tooltips
            $('[data-toggle="tooltip"]').tooltip();

        }());
    });

})(jQuery);
