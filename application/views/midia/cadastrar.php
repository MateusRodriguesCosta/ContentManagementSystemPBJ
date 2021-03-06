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
				<li class="breadcrumb-link"><?php echo anchor('Mídia', 'Mídia', 'title="Clique para ir"'); ?></li>
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
						<div class="panel-heading"><div class="panel-title">Nova Mídia</div></div>
						<div class="panel-body">
							<?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>','</strong></div>'); ?>
							<?php echo form_open_multipart('Midia/Inserir', 'id="form-ui"'); ?>
							<div class="row">
								<div class="col-md-12">
									<div class="section">
										<span title="Campo obrigatório" class="help-block">Escolha uma página</span>
										<label class="field select">
											<select name="opcao" required id="opcao">
												<option value="Página Principal">Página Principal</option>
												<option value="A Pousada - Visitas Ilustres">A Pousada - Visitas Ilustres</option>
												<option value="Fé e Lazer - Pousada">Fé e Lazer - Pousada</option>
												<option value="Eventos - Ambientes">Eventos - Ambientes</option>
												<option value="Restaurante">Restaurante</option>
											</select>
											<i class="arrow"></i>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4" style="margin-top: 5px;" id="divTitulo">
									<span title="Obrigatório" class="help-block">Título <span class="text-danger">*</span></span>
									<label class="field prepend-icon">
										<input name="titulo" value="" placeholder="Título da mídia" maxlength="65" required id="titulo" class="gui-input" autocomplete="off">
										<label for="titulo" class="field-icon"><i class="fa fa-font"></i></label>
									</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 5px;" id="divInclusao">
									<span class="help-block">Data de Inclusão</span>
									<label class="field prepend-icon">
										<input type="text" name="dataInclusao" value="<?php echo date('d/m/Y'); ?>" readonly="true" onmousedown="return false;" onselectstart="return false;" placeholder="Data de Inclusão do Banner" required id="dataInclusao" class="gui-input" autocomplete="off">
										<label for="dataInclusao" class="field-icon"><i class="fa fa-calendar"></i></label>
									</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 5px;" id="divLink">
									<span class="help-block">Link</span>
									<label class="field prepend-icon">
										<input name="link" value="" placeholder="Link" maxlength="150" id="link" class="gui-input" autocomplete="off">
										<label for="link" class="field-icon"><i class="fa fa-link"></i></label>
									</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4" style="margin-top: 5px;" id="divPeriodo">
									<span class="help-block">Período <span class="text-danger">*</span></span>
									<label class="field prepend-icon">
										<input name="periodo" value="" placeholder="Período da visita" maxlength="45" id="periodo" class="gui-input" autocomplete="off">
										<label for="periodo" class="field-icon"><i class="fa fa-calendar"></i></label>
									</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6" id="divCapacidade">
									<span class="help-block">Capacidade <span class="text-danger">*</span></span>
									<label class="field prepend-icon">
										<input name="capacidade" value="" placeholder="Capacidade do ambiente" maxlength="45" id="capacidade" class="gui-input" autocomplete="off">
										<label for="capacidade" class="field-icon"><i class="fa fa-group"></i></label>
									</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6" id="divEquipamentos">
									<span class="help-block">Equipamentos <span class="text-danger">*</span></span>
									<label class="field prepend-icon">
										<input name="equipamentos" value="" placeholder="Equipamentos disponíveis" id="equipamentos" class="gui-input" autocomplete="off">
										<label for="equipamentos" class="field-icon"><i class="fa fa-gears"></i></label>
									</label>
								</div>
							</div>
							<div class="row" style="margin-top: 30px;" id="divDescricao">
								<div class="col-md-12">
									<div class="section">
										<span title="Obrigatório" class="help-block"><i class="fa fa-file-text-o"></i> Descrição </span>
									</div>
									<textarea id="textoEditor" placeholder="Entre com o texto da mídia" name="texto" class="gui-textarea"></textarea>
								</div>
							</div>
							<div class="row" style="margin-top: 35px;">
								<div class="col-xs-12 col-sm-9 col-md-9 center-block" id="divImagem">
									<span title="Obrigatório" class="help-block">Edição da Imagem</span>
									<div class="img-container pv10" style="background: #ffffff;min-height:480px !important">
										<img src="<?php echo base_url('assets/img/patterns/canvas/placeholder455x305.png'); ?>">
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
									<button id="enviar" type="submit" data-method="getCroppedCanvas" class="btn btn-bordered btn-warning mb5 pull-right"><span class="fa fa-plus"></span> Inserir Novo</button>
									<!-- Informações para diversas classes-->
									<input type="hidden" id="limparImagem" value="false"></input>
									<label id="usuario" style="display:none;"><?php echo $this->session->user_nome; ?></label>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
