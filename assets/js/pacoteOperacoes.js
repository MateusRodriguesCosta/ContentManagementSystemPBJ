jQuery(document).ready(function() {
  var incluir = $( "#incluir" );
  var excluir = $( "#excluir" );
  var container  = $( "#section-regulamentos" );
  var quantidade = $('#regulamento-quantidade');
  var indice  = ($('.label-regra').length > 0)? $('.label-regra').length : 1;
  quantidade.text(indice);

  incluir.click(function() {
    var elemento  = '<label id="label'+indice+'" class="field prepend-icon" style="margin-bottom: 10px;"><input name="regulamento'+indice+'" value="" placeholder="Regulamento do Pacote" maxlength="512" required id="regulamento'+indice+'" class="gui-input" autocomplete="off"><label for="regulamento'+indice+'" class="field-icon"><i class="fa fa-font"></i></label></label>';
    container.append(elemento);
    indice++;
    quantidade.text(indice);
  });

  excluir.click(function() {
    (indice>1)? indice-- : indice;
    var elemento = '#label'+indice;
    $(elemento).remove();
    quantidade.text(indice);
  });

});
