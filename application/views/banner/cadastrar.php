<!-- Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
Confidencial e proprietário
Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017 -->

<section id="content_wrapper">
  <header id="topbar" class="alt">
    <div class="topbar-left">
      <ol class="breadcrumb">
        <li class="breadcrumb-icon"><?php echo anchor('', '<span class="fa fa-home"></span>', 'title="Clique para ir"'); ?></li>
        <li class="breadcrumb-active"><?php echo anchor('', 'Menu Principal', 'title="Clique para ir"'); ?></li>
        <li class="breadcrumb-link"><?php echo anchor('Banner', 'Banner', 'title="Clique para ir"'); ?></li>
        <li class="breadcrumb-current-item">Cadastrar</li>
      </ol>
    </div>
    <div class="topbar-right"></div>
  </header>

  <section id="content" class="table-layout animated fadeIn">
    <div class="chute chute-center">
      <div class="mw1500 center-block">
        <div class="allcp-form">
          <div class="panel">
            <div class="panel-heading"><div class="panel-title">Novo Banner</div></div>
            <div class="panel-body">
              <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>','</strong></div>'); ?>
              <?php echo form_open_multipart('Banner/Inserir', 'id="form-ui"'); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="section">
                    <span title="Campo obrigatório" class="help-block">Título <span class="text-danger">*</span></span>
                    <label class="field prepend-icon">
                      <input name="titulo" value="" placeholder="Título do Banner" maxlength="65" required id="titulo" class="gui-input" autocomplete="off">
                      <label for="titulo" class="field-icon"><i class="fa fa-font"></i></label>
                    </label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="section">
                    <span class="help-block">Link</span>
                    <label class="field prepend-icon">
                      <input name="link" value="" placeholder="Link" maxlength="150" id="link" class="gui-input" autocomplete="off">
                      <label for="link" class="field-icon"><i class="fa fa-link"></i></label>
                    </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="section">
                    <span class="help-block">Data de Inclusão</span>
                    <label class="field prepend-icon">
                      <input type="text" name="dataInclusao" value="<?php echo date('d/m/Y'); ?>" readonly="true" onmousedown="return false;" onselectstart="return false;" placeholder="Data de Inclusão do Banner" id="dataInclusao" class="gui-input" autocomplete="off">
                      <label for="dataInclusao" class="field-icon"><i class="fa fa-calendar"></i></label>
                    </label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="section">
                    <span title="Campo obrigatório" class="help-block">Data de Expiração <span class="text-danger">*</span></span>
                    <label class="field prepend-icon">
                      <input type="text" name="dataExpiracao" value="" placeholder="Data de Expiração do Banner" required id="dataExpiracao" class="gui-input" autocomplete="off">
                      <label for="dataExpiracao" class="field-icon"><i class="fa fa-calendar"></i></label>
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 center-block">
                <span title="Obrigatório" class="help-block">Edição do Banner</span>
                <div class="img-container pv10" style="background: #ffffff;min-height:650px !important">
                  <img src="<?php echo base_url('assets/img/patterns/canvas/placeholder1920x675.png');?>">
                  <div class="panel-footer" style="position: absolute;right:3%;bottom:8%;z-index: 500">
                    <div class="docs-buttons text-center">
                      <div class="btn-group">
                        <label class="btn btn-warning btn-sm btn-upload" for="inputImage" title="Upload de imagem" style="width: 300px;-webkit-box-shadow: 2px 2px 24px 6px rgba(50, 50, 50, 1);-moz-box-shadow: 2px 2px 24px 6px rgba(50, 50, 50, 1);box-shadow: 2px 2px 24px 6px rgba(50, 50, 50, 1);">
                          <input class="sr-only" id="inputImage" name="file" type="file" accept="image/*">Upload de Imagem
                          <p><span class="fa fa-upload"></span></p>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <p class="text-center" style="font-size:14px;color:#bdbdbd;">Imagens que excederem 2MB ou com dimensões maiores que FULL HD não serão salvas</p>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-offset-10 col-md-2">
                <button type="submit" class="btn btn-bordered btn-warning mb5 pull-right" data-method="getCroppedCanvas" id="enviar"><span class="fa fa-plus"></span> Inserir Novo</button>
                <!-- Informações para diversas classes-->
                <input type="hidden" id="limparImagem" value="false"></input>
                <label id="usuario" style="display:none;"><?php echo $this->session->user_nome; ?></label>
              </div>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </section>
  </section>
