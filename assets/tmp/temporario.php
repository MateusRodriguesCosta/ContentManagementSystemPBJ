<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

class temporario {
   # Verificar situação de imagens que foram editadas,
   # que renovaram e o caminho no qual serão salvas.
   # @var     midia       String   Código de identificação da mídia para salvar o arquivo
   # @var     usuario       -      Identificação do usuário para localizar temporário
   # @var     tipo          -      Tipo de item (Banner, imagem ou mídia)
   # @var     operacao      -      Operação de inserção ou atualização
   # @var     flag          -      Variável utilizada para verificação das edições
   # @return  @caminho      -      Retorna o caminho no qual foi salvo o arquivo
   public function salvar($midia, $usuario, $tipo, $operacao, $flag, $totalArquivos){
     # Percorre arquivos recebidos por ajax do $usuario e constrói array
     # de Strings na base64.
     # Arquivos -> Array
     $contador  = 0;
     while ($contador < $totalArquivos):
       if (file_exists("edicao_tmp_recorte_".$usuario."_parte_".$contador.".txt")):
         $resultado[$contador] = file_get_contents("edicao_tmp_recorte_".$usuario."_parte_".$contador.".txt");
         unlink("edicao_tmp_recorte_".$usuario."_parte_".$contador.".txt");
         $contador = $contador + 1;
       endif;
     endwhile;

     # Trata e decodifica string base64 para arquivo temporário e
     # define os paths que serão utilizados na manipulação.
     # Array -> Arquivo Edição
     if (isset($resultado)):
       $resultado = explode(',',implode('',$resultado));
       $resultado = base64_decode($resultado[1]);
       file_put_contents("edicao_tmp_recorte_".$usuario.".jpg", $resultado);
     endif;

     # Caso a execução do script seja realizada pela instancia
     # do arquivo temporario os caminhos serão:
     $caminhoTemporarioOriginal = 'edicao_tmp_'.$usuario.'.jpg';
     $caminhoTemporarioEdicao   = 'edicao_tmp_recorte_'.$usuario.'.jpg';
     $caminhoDefinitivoOriginal = dirname(__DIR__).'/img/pousada_originais/'.$tipo.'_'.$midia.'.jpg';
     $caminhoDefinitivoEdicao   = dirname(__DIR__).'/img/pousada_'.$tipo.'/'.$tipo.'_'.$midia.'.jpg';
     $validacao                 = "validacao_".$usuario.".txt";
     # Mas se a exeução for realizada através do controller
     # os caminhos serão:
     if ($flag == 'false') {
       $caminhoTemporarioOriginal = 'assets/tmp/edicao_tmp_'.$usuario.'.jpg';
       $caminhoTemporarioEdicao   = 'assets/tmp/edicao_tmp_recorte_'.$usuario.'.jpg';
       $caminhoDefinitivoOriginal = 'assets/img/pousada_originais/'.$tipo.'_'.$midia.'.jpg';
       $caminhoDefinitivoEdicao   = 'assets/img/pousada_'.$tipo.'/'.$tipo.'_'.$midia.'.jpg';
       $validacao                 = "assets/tmp/validacao_".$usuario.".txt";
     }

     if ($flag == 'true' && file_exists($caminhoTemporarioOriginal)):
       # Edição -> Local Definitivo do Arquivo Final
       copy($caminhoTemporarioEdicao,$caminhoDefinitivoEdicao);
       chmod($caminhoDefinitivoEdicao, 0777);
       # Original -> Local Definitivo dos Arquivos Originais
       copy($caminhoTemporarioOriginal,$caminhoDefinitivoOriginal);
       chmod($caminhoDefinitivoOriginal, 0777);

     elseif ($flag == 'true' && !file_exists($caminhoTemporarioOriginal)):
       # Edição -> Local Definitivo do Arquivo Final
       copy($caminhoTemporarioEdicao,$caminhoDefinitivoEdicao);
       chmod($caminhoDefinitivoEdicao, 0777);

     elseif ($flag == 'false' && file_exists($caminhoTemporarioOriginal)):
       # Original -> Local Definitivo do Arquivo Final
       copy($caminhoTemporarioOriginal,$caminhoDefinitivoEdicao);
       chmod($caminhoDefinitivoEdicao, 0777);
       # Original -> Local Definitivo dos Arquivos Originais
       copy($caminhoTemporarioOriginal,$caminhoDefinitivoOriginal);
       chmod($caminhoDefinitivoOriginal, 0777);

     elseif ($flag == 'false' && !file_exists($caminhoTemporarioOriginal) && $operacao == 'inserir'):
       # Placeholder -> Local Definitivo do Arquivo Final
       copy(dirname(__DIR__).'/img/patterns/canvas/placeholder.png',$caminhoDefinitivoEdicao);
       chmod($caminhoDefinitivoEdicao, 0777);
       # Original -> Local Definitivo dos Arquivos Originais
       copy(dirname(__DIR__).'/img/patterns/canvas/placeholder.png',$caminhoDefinitivoOriginal);
       chmod($caminhoDefinitivoOriginal, 0777);

     endif;

     # Original & Edição -> Destroy
     if(file_exists($caminhoTemporarioOriginal)):
       unlink($caminhoTemporarioOriginal);
     endif;
     if(file_exists($caminhoTemporarioEdicao)):
       unlink($caminhoTemporarioEdicao);
     endif;
     if(file_exists($validacao)):
       unlink($validacao);
     endif;
   }
}

if(isset($_POST['upload'])):
  $usuario  = $_POST['user'];
  file_put_contents("validacao_".$usuario.".txt", 'validação para form validation das imagens');
endif;

if(isset($_POST['original'])):

  # Salva arquivo jpg da edição
  # POST -> Original
  $original = json_decode($_POST['original']);
  $usuario  = $_POST['user'];
  file_put_contents("edicao_tmp_".$usuario.".jpg", file_get_contents($original));

endif;

if(isset($_POST['recorte'])):

  # Recebe arquivos da Edição
  $recorte              = json_decode($_POST['recorte']);
  $parte                = $_POST['ordemAJAX'];
  $usuario              = $_POST['user'];
  $totalArquivos        = $_POST['numeroArquivos'];
  $totalArquivosProntos = true;

  # Cria arquivos separados de cada envio
  # POST -> Edição $parte
  $arquivo = fopen("edicao_tmp_recorte_".$usuario."_parte_".$parte.".txt", "w")
    or die("Não foi possível abrir o arquivo!");
  fwrite($arquivo,$recorte);
  fclose($arquivo);

  # Verifica se todos arquivos, do total de divisões, já foram alocados
  for ($i=0; $i < $totalArquivos; $i++):
    if (!file_exists("edicao_tmp_recorte_".$usuario."_parte_".$i.".txt")):
      $totalArquivosProntos = false;
    endif;
  endfor;

  # Recebe dados da Edição
  # executa método para salvar Edição
  if ($totalArquivosProntos == true):
    $temporario = new temporario();
    if (file_exists("edicao_".$usuario.".txt")):
      $dados        = file_get_contents("edicao_".$usuario.".txt");
      $dados        = explode(',',$dados);
      $midia        = $dados[0];
      $tipo         = $dados[1];
      $verificacao  = $dados[2];
      $operacao     = $dados[3];
      unlink("edicao_".$usuario.".txt");
      $temporario->salvar($midia, $usuario, $tipo, $operacao, $verificacao, $totalArquivos);
    endif;
  endif;
endif;

?>
