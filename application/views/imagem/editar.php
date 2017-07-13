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
				<li class="breadcrumb-link"><?php echo anchor('Imagem', 'Imagem', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-current-item">Editar</li>
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>
	<section id="content" class="table-layout animated fadeIn">
		<div class="chute chute-center">
			<div class="mw1500 center-block">
				<div class="allcp-form">
					<div class="panel">
						<div class="panel-heading"><div class="panel-title">Editar Imagem</div></div>
						<div class="panel-body">
							<?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>','</strong></div>'); ?>
							<?php echo form_open_multipart('Imagem/atualizar', 'id="form-ui"', array('id'=>$this->imagem_m->getId())); ?>
							<div class="row">
								<div class="col-md-12">
									<div class="section">
										<span title="Campo obrigatório" class="help-block">Título <span class="text-danger">*</span></span>
										<label class="field prepend-icon">
											<input name="titulo" value="<?php echo $this->midia_m->getTitulo(); ?>" placeholder="Título da Imagem" maxlength="42" required id="titulo" class="gui-input">
											<label for="titulo" class="field-icon"><i class="fa fa-font"></i></label>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="section">
										<span class="help-block">Data de Inclusão</span>
										<label class="field prepend-icon">
											<input name="dataInclusao" value=" <?php echo $this->imagem_m->getDataInclusao(); ?>" readonly="true" onmousedown="return false;" onselectstart="return false;" placeholder="Data de Inclusão do Banner" maxlength="42" required id="dataInclusao" class="gui-input">
											<label for="dataInclusao" class="field-icon"><i class="fa fa-calendar"></i></label>
										</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="section">
										<span class="help-block">Data de Alteração</span>
										<label class="field prepend-icon">
											<input name="dataAlteracao" value=" <?php echo date('d/m/Y'); ?>" readonly="true" onmousedown="return false;" onselectstart="return false;" placeholder="Data de Alteração do Banner" maxlength="42" required id="dataAlteracao" class="gui-input">
											<label for="dataAlteracao" class="field-icon"><i class="fa fa-calendar"></i></label>
										</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="section">
										<span title="Campo obrigatório" class="help-block">Habilitar <span class="text-danger">*</span></span>
										<label class="field select">
											<select name="ativo" required id="ativo">
												<?php echo $this->texto_m->ativo_selecionar($this->imagem_m->getAtivo()); ?>
											</select>
											<i class="arrow"></i>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-10 center-block">
									<span title="Obrigatório" class="help-block">Edição da Imagem</span>
									<div class="img-container pv10" style="background: #ffffff;">
										<img src="<?php
										if($this->imagem_m->getCaminho() != "" || $this->imagem_m->getCaminho() != null){
											echo base_url('assets/img/pousada_imagem/'.$this->imagem_m->getCaminho().'?dummy='.date("d/m/YH:m:s"));
										}else{
											echo base_url('assets/img/patterns/canvas/placeholder.png');
										}
										?>">
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="docs-buttons text-center">
									<div class="btn-group">
										<button class="btn btn-warning btn-sm" data-method="setDragMode" data-option="crop" type="button" title="Recortar">RECORTAR
											<p><span class="fa fa-crop"></span></p>
										</button>
										<button class="btn btn-warning btn-sm" data-method="clear" type="button" title="Limpar recorte">Limpar
											<p><span class="fa fa-remove"></span></p>
										</button>
										<button class="btn btn-warning btn-sm" data-method="zoom" data-option="0.1" type="button" title="Mais zoom">Ampliar
											<p><span class="fa fa-search-plus"></span></p>
										</button>
										<button class="btn btn-warning btn-sm" data-method="zoom" data-option="-0.1" type="button" title="Menos zoom">Reduzir
											<p><span class="fa fa-search-minus"></span></p>
										</button>
										<button class="btn btn-warning btn-sm" data-method="rotate" data-option="-45" type="button" title="Girar para esquerda">Esquerda
											<p><span class="fa fa-rotate-left"></span></p>
										</button>
										<button class="btn btn-warning btn-sm" data-method="rotate" data-option="45" type="button" title="Girar para direita">Direita
											<p><span class="fa fa-rotate-right"></span></p>
										</button>
										<button class="btn btn-warning btn-sm" data-method="reset" type="button" title="Resetar edição">Resetar
											<p><span class="fa fa-refresh"></span></p>
										</button>
										<label class="btn btn-warning btn-sm btn-upload" for="inputImage" title="Upload de imagem">
											<input class="sr-only js-fileinput img-upload" onchange=<?php echo "'readURL(this,".$this->session->user_nome.");'"; ?> id="inputImage" name="file" type="file" accept="image/*">Upload
											<p><span class="fa fa-upload"></span></p>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-offset-10 col-md-2">
									<button id="enviar" type="submit" data-method="getCroppedCanvas" class="btn btn-bordered btn-warning mb5 pull-right"><span class="fa fa-check"></span> Salvar Edição</button>
									<!-- Informações para diversas classes-->
									<input type="hidden" class="gui-input" name="verificacao" id="verificacao" value=""></input>
									<input type="hidden" class="gui-input" name="user" id="user" value=<?php echo '"'.$this->session->user_id.'"';?>></input>
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
