<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, julho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Edicao_m extends CI_Model {
  # Verificar a resolução de imagens que foram selecionadas.
  # @usuario                 String     Identificação do usuário para localizar temporário
  # [return]                 boolean    Retorna boolean se a resolução é valida ou não
  public function validarResolucao($usuario){

    $caminhoTemporarioOriginal = 'assets/tmp/edicao_tmp_'.$usuario.'.jpg';
    if (file_exists($caminhoTemporarioOriginal)) {
      $resolucao = getimagesize($caminhoTemporarioOriginal);

      if($resolucao!=false){

        # resolucao = larguraxaltura
        $largura = $resolucao[0];
        $altura = $resolucao[1];

        if($largura>1920 && $altura>1080){

          # Elimina imagem que não possui tamanho adequado
          unlink($caminhoTemporarioOriginal);
          return false;

        } else {
          return true;
        }
      } else {
        return true;
      }
    } else {
      return true;
    }
  }
}

?>
