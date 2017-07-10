/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

'use strict';
var Demo = function() {

  var runFullscreenDemo = function() {

    // If browser is IE we need to pass the fullsreen plugin the 'html' selector
    // rather than the 'body' selector. Fixes a fullscreen overflow bug
    var selector = $('html');

    var ua = window.navigator.userAgent;
    var old_ie = ua.indexOf('MSIE ');
    var new_ie = ua.indexOf('Trident/');
    if ((old_ie > -1) || (new_ie > -1)) { selector = $('body'); }

    // Fullscreen Functionality
    var screenCheck = $.fullscreen.isNativelySupported();

    // Attach handler to navbar fullscreen button
    $('.navbar-fullscreen').on('click', function() {

      // Check for fullscreen browser support
      if (screenCheck) {
        if ($.fullscreen.isFullScreen()) {
          $.fullscreen.exit();
        }
        else {
          selector.fullscreen({
            overflow: 'auto'
          });
        }
      } else {
        alert('Your browser does not support fullscreen mode.')
      }
    });

  }

  return {
    init: function() {
      runFullscreenDemo();
    }
  }
}();
