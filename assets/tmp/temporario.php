<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

if(isset($_POST['original'])){

  // Salva arquivo jpg da edição
  $original = json_decode($_POST['original']);
  $usuario  = $_POST['user'];
  file_put_contents("edicao_tmp_".$usuario.".jpg", file_get_contents($original));

}

if(isset($_POST['recorte'])){

  // Salva arquivo jpg da edição
  $recorte = json_decode($_POST['recorte']);
  $usuario = $_POST['user'];
  file_put_contents("edicao_tmp_recorte_".$usuario.".jpg", file_get_contents($recorte));

}
?>
