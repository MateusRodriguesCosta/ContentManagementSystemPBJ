/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

jQuery(document).ready(function() {

  var opcaoEdicao = $( '#opcaoEditar' );
  var opcaoCadastro = $( '#opcao' );
  if (opcaoCadastro.length) {
    prepararCadastro();
  }else if(opcaoEdicao.length){
    prepararEdicao();
  }
});
/**
* Função de seleção das diferentes páginas de mídias. Por gatilho
* @opcao Object [object]
*/
$( "#opcao" ).change(function() {
  var opcao = $( this ).find( "option:selected" ).text();
  switch (opcao) {
    case 'A Pousada - Visitas Ilustres':
    $( "#divPeriodo" ).attr('Style', 'margin-top: 5px;');
    $( "#periodo" ).prop('required',true);
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-4');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-4');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-6 col-md-4');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#capacidade" ).removeAttr('required');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#equipamentos" ).removeAttr('required');
    break;
    case 'Fé e Lazer - Pousada':
    case 'Restaurante':
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#divPeriodo" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
    case 'Eventos - Ambientes':
    $( "#capacidade" ).prop('required',true);
    $( "#equipamentos" ).prop('required',true);

    $( "#divCapacidade" ).attr('Style', 'margin-top: 5px;');
    $( "#divEquipamentos" ).attr('Style', 'margin-top: 5px;');
    $( "#divCapacidade" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divEquipamentos" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divDescricao" ).attr('Style', 'display: none;');

    $( "#periodo" ).removeAttr('required');
    $( "#descricao" ).removeAttr('required');
    break;
    default:
    $( "#divLink" ).attr('Style', 'margin-top: 5px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-12');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divLink" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
  }
});

/**
* Função de seleção das diferentes páginas de edição mídias. Por gatilho
* @opcao Object [object]
*/
$( "#opcaoEditar" ).change(function() {
  var opcao = $( this ).find( "option:selected" ).text();
  switch (opcao) {
    case 'A Pousada - Visitas Ilustres':
    $( "#divPeriodo" ).attr('Style', 'margin-top: 20px;');
    $( "#divInclusao" ).attr('Style', 'margin-top: 20px;');
    $( "#divAlteracao" ).attr('Style', 'margin-top: 20px;');
    $( "#periodo" ).prop('required',true);
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#capacidade" ).removeAttr('required');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#equipamentos" ).removeAttr('required');
    break;
    case 'Fé e Lazer - Pousada':
    case 'Restaurante':
    $( "#divInclusao" ).attr('Style', 'margin-top: 20px;');
    $( "#divAlteracao" ).attr('Style', 'margin-top: 20px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#divPeriodo" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
    case 'Eventos - Ambientes':
    $( "#capacidade" ).prop('required',true);
    $( "#equipamentos" ).prop('required',true);

    $( "#divCapacidade" ).attr('Style', 'margin-top: 20px;');
    $( "#divEquipamentos" ).attr('Style', 'margin-top: 20px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divDescricao" ).attr('Style', 'display: none;');

    $( "#periodo" ).removeAttr('required');
    $( "#descricao" ).removeAttr('required');
    break;
    default:
    $( "#divLink" ).attr('Style', 'margin-top: 20px;');
    $( "#divInclusao" ).attr('Style', 'margin-top: 20px;');
    $( "#divAlteracao" ).attr('Style', 'margin-top: 20px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divLink" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
  }
});

/**
* Função de seleção das diferentes páginas de mídias. Automática
*/
function prepararCadastro(){
  var opcao = $( '#opcao' ).find( "option:selected" ).text();
  switch (opcao) {
    case 'A Pousada - Visitas Ilustres':
    $( "#divPeriodo" ).attr('Style', 'margin-top: 5px;');
    $( "#periodo" ).prop('required',true);
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-4');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-4');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-6 col-md-4');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#capacidade" ).removeAttr('required');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#equipamentos" ).removeAttr('required');
    break;
    case 'Fé e Lazer - Pousada':
    case 'Restaurante':
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#divPeriodo" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
    case 'Eventos - Ambientes':
    $( "#capacidade" ).prop('required',true);
    $( "#equipamentos" ).prop('required',true);

    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-12 col-md-6');
    $( "#divCapacidade" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divEquipamentos" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divDescricao" ).attr('Style', 'display: none;');

    $( "#periodo" ).removeAttr('required');
    $( "#descricao" ).removeAttr('required');
    break;
    default:
    $( "#divLink" ).attr('Style', 'margin-top: 5px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-12 col-md-12');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-6 col-md-4');
    $( "#divLink" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
  }
}


function prepararEdicao(){
  var opcao = $( '#opcaoEditar' ).find( "option:selected" ).text();
  switch (opcao) {
    case 'A Pousada - Visitas Ilustres':
    $( "#divPeriodo" ).attr('Style', 'margin-top: 20px;');
    $( "#divInclusao" ).attr('Style', 'margin-top: 20px;');
    $( "#divAlteracao" ).attr('Style', 'margin-top: 20px;');
    $( "#periodo" ).prop('required',true);
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#capacidade" ).removeAttr('required');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#equipamentos" ).removeAttr('required');
    break;
    case 'Fé e Lazer - Pousada':
    case 'Restaurante':
    $( "#divInclusao" ).attr('Style', 'margin-top: 20px;');
    $( "#divAlteracao" ).attr('Style', 'margin-top: 20px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');
    $( "#divPeriodo" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
    case 'Eventos - Ambientes':
    $( "#capacidade" ).prop('required',true);
    $( "#equipamentos" ).prop('required',true);

    $( "#divCapacidade" ).attr('Style', 'margin-top: 20px;');
    $( "#divEquipamentos" ).attr('Style', 'margin-top: 20px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-6 col-md-6');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divLink" ).attr('Style', 'display: none;');
    $( "#divDescricao" ).attr('Style', 'display: none;');

    $( "#periodo" ).removeAttr('required');
    $( "#descricao" ).removeAttr('required');
    break;
    default:
    $( "#divLink" ).attr('Style', 'margin-top: 20px;');
    $( "#divInclusao" ).attr('Style', 'margin-top: 20px;');
    $( "#divAlteracao" ).attr('Style', 'margin-top: 20px;');
    $( "#divTitulo" ).attr('class', 'col-xs-12 col-sm-10 col-md-10');
    $( "#divAtivo" ).attr('class', 'col-xs-12 col-sm-2 col-md-2');
    $( "#divInclusao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divAlteracao" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divPeriodo" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divLink" ).attr('class', 'col-xs-12 col-sm-4 col-md-4');
    $( "#divDescricao" ).attr('Style', 'margin-top: 30px;');

    $( "#divPeriodo" ).attr('Style', 'display: none;');
    $( "#divCapacidade" ).attr('Style', 'display: none;');
    $( "#divEquipamentos" ).attr('Style', 'display: none;');

    $( "#capacidade" ).removeAttr('required');
    $( "#equipamentos" ).removeAttr('required');
    $( "#periodo" ).removeAttr('required');
    break;
  }
}
