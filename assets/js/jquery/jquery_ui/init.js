// datePicker para sobrepor default que não funciona em Firefox e IE
$( "input[name='dataExpiracao']" ).datepicker({
  dateFormat: "dd/mm/yy",
  dayNames: [ "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo" ],
  dayNamesMin: [ "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom" ],
  monthNames: [ "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
  prevText: "Anterior",
  nextText: "Próximo"
});
