<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, julho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Edicao_m extends CI_Model {
    # Verificar situação de imagens que foram editadas,
    # que renovaram e o caminho no qual serão salvas.
    # @midia                      String   Código de identificação da mídia para salvar o arquivo
    # @usuario                      -      Identificação do usuário para localizar temporário
    # @tipo                         -      Tipo de item (Banner, imagem ou mídia)
    # @operacao                     -      Operação de inserção ou atualização
    # @flag                         -      Variável utilizada para verificação das edições
    # [return] @caminho             -      Retorna o caminho no qual foi salvo o arquivo
    public function salvar($midia, $usuario, $tipo, $operacao, $flag){

      $caminhoTemporarioOriginal = 'assets/tmp/edicao_tmp_'.$usuario.'.jpg';
      $caminhoTemporarioEdicao   = 'assets/tmp/edicao_tmp_recorte_'.$usuario.'.jpg';
      $caminhoDefinitivoOriginal = 'assets/img/pousada_originais/'.$tipo.'_'.$midia.'.jpg';
      $caminhoDefinitivoEdicao   = 'assets/img/pousada_'.$tipo.'/'.$tipo.'_'.$midia.'.jpg';
      $caminho = explode('/',$caminhoDefinitivoEdicao)[3];

      if ($flag == 'true' && file_exists($caminhoTemporarioOriginal)) {

        # Edição -> Local Definitivo do Arquivo Final
        copy($caminhoTemporarioEdicao,$caminhoDefinitivoEdicao);
        chmod($caminhoDefinitivoEdicao, 0777);
        # Original -> Local Definitivo dos Arquivos Originais
				copy($caminhoTemporarioOriginal,$caminhoDefinitivoOriginal);
				chmod($caminhoDefinitivoOriginal, 0777);

      } else if ($flag == 'true' && !file_exists($caminhoTemporarioOriginal)) {

        # Edição -> Local Definitivo do Arquivo Final
        copy($caminhoTemporarioEdicao,$caminhoDefinitivoEdicao);
        chmod($caminhoDefinitivoEdicao, 0777);

      } else if ($flag == 'false' && file_exists($caminhoTemporarioOriginal)) {

        # Original -> Local Definitivo do Arquivo Final
        copy($caminhoTemporarioOriginal,$caminhoDefinitivoEdicao);
        chmod($caminhoDefinitivoEdicao, 0777);
        # Original -> Local Definitivo dos Arquivos Originais
				copy($caminhoTemporarioOriginal,$caminhoDefinitivoOriginal);
				chmod($caminhoDefinitivoOriginal, 0777);

      } else if ($flag == 'false' && !file_exists($caminhoTemporarioOriginal) && $operacao == 'inserir') {

        # Placeholder -> Local Definitivo do Arquivo Final
        copy(base_url('assets/img/patterns/canvas/placeholder.png'),$caminhoDefinitivoEdicao);
        chmod($caminhoDefinitivoEdicao, 0777);
        # Original -> Local Definitivo dos Arquivos Originais
				copy(base_url('assets/img/patterns/canvas/placeholder.png'),$caminhoDefinitivoOriginal);
				chmod($caminhoDefinitivoOriginal, 0777);

      }

      # Original -> Destroy
      if(file_exists($caminhoTemporarioOriginal)) {unlink($caminhoTemporarioOriginal);}

      return $caminho;
    }

    # Verificar a resolução de imagens que foram selecionadas.
    # @usuario                 String     Identificação do usuário para localizar temporário
    # [return]                 boolean    Retorna boolean se a resolução é valida ou não
    public function validarResolucao($usuario){

      $caminhoTemporarioOriginal = 'assets/tmp/edicao_tmp_'.$usuario.'.jpg';
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
    }
}

?>
