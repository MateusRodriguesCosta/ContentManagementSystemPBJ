<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Edicao_m extends CI_Model {
    # Verificar situação de imagens que foram editadas,
    # que renovaram e o caminho no qual serão salvas.
    # @idMidia                    String   Código de identificação da mídia para salvar o arquivo
    # @idUsuario                    -      Código de identificação do usuário para localizar temporário
    # @tipo                         -      Tipo de item (Banner, imagem ou mídia)
    # @flag                         -      Variável utilizada para verificação das edições
    # [return] @caminho             -      Retorna o caminho no qual foi salvo o arquivo
    public function salvar($idMidia, $idUsuario, $tipo, $flag){

      $caminhoTemporarioOriginal = 'assets/tmp/edicao_tmp_'.$idUsuario.'.jpg';
      $caminhoTemporarioEdicao   = 'assets/tmp/edicao_tmp_recorte_'.$idUsuario.'.jpg';
      $caminhoDefinitivoOriginal = 'assets/img/pousada_originais/'.$tipo.'_'.$idMidia.'.jpg';
      $caminhoDefinitivoEdicao   = 'assets/img/pousada_'.$tipo.'/'.$tipo.'_'.$idMidia.'.jpg';
      $caminho = explode('/',$caminhoDefinitivoEdicao)[3];

      if ($flag == 'true') {

        # Edição -> Local Definitivo do Arquivo Final
        copy($caminhoTemporarioEdicao,$caminhoDefinitivoEdicao);
        chmod($caminhoDefinitivoEdicao, 0777);

      } else if ($flag == 'false') {

        if (file_exists($caminhoTemporarioOriginal)) {

          # Original -> Local Definitivo do Arquivo Final
          copy($caminhoTemporarioOriginal,$caminhoDefinitivoEdicao);
          chmod($caminhoDefinitivoEdicao, 0777);

        } else {

          # Placeholder -> Local Definitivo do Arquivo Final
          copy(base_url('assets/img/patterns/canvas/placeholder.png'),$caminhoDefinitivoEdicao);
          chmod($caminhoDefinitivoEdicao, 0777);

        }

      }

      if (file_exists($caminhoTemporarioOriginal)) {

        # Original -> Local Definitivo dos Arquivos Originais
				copy($caminhoTemporarioOriginal,$caminhoDefinitivoOriginal);
				chmod($caminhoDefinitivoOriginal, 0777);

			}else {

        # Placeholder -> Local Definitivo dos Arquivos Originais
				copy(base_url('assets/img/patterns/canvas/placeholder.png'),$caminhoDefinitivoOriginal);
				chmod($caminhoDefinitivoOriginal, 0777);

			}

      # Original -> Destroy
      if(file_exists($caminhoTemporarioOriginal)) {unlink($caminhoTemporarioOriginal);}

      return $caminho;
    }

}

?>
