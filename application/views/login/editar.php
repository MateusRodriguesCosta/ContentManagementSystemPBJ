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
				<li class="breadcrumb-link"><?php echo anchor('', 'ArqCentral', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-link"><?php echo anchor('', 'Configura&ccedil;&otilde;es', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-link"><?php echo anchor('Login', 'Login', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-link"><?php echo anchor('Login', 'Editar', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-current-item"><?php echo anchor('Colaborador/Editar/'.$this->colaborador_m->getId(), $this->colaborador_m->getColaborador(), 'title="Clique para ir"'); ?></li>
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>
	<section id="content" class="table-layout animated fadeIn">
		<div class="chute chute-center">
			<div class="mw1500 center-block">
				<div class="allcp-form">
					<div class="panel">
						<div class="panel-heading"><div class="panel-title">Editar Login</div></div>
						<div class="panel-body">
							<?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>','</strong></div>'); ?>
							<?php echo form_open('Login/Update', 'id="form-ui"', array('id'=>$this->login_m->getColaborador())); ?>
							<div class="row">
								<div class="col-md-5">
									<div class="section">
										<span title="Obrigatório" class="help-block">Login <span class="text-danger">*</span></span>
										<label class="field prepend-icon">
											<input name="login" value="<?php echo $this->login_m->getLogin(); ?>" placeholder="Nome do Login" required id="login" class="gui-input">
											<label for="login" class="field-icon"><i class="fa fa-user"></i></label>
										</label>
									</div>
								</div>
								<div class="col-md-5">
									<div class="section">
										<span title="Obrigatório" class="help-block">Permissão <span class="text-danger">*</span></span>
										<label class="field prepend-icon">
											<input name="permissao" value="<?php echo $this->login_m->getPermissao(); ?>" placeholder="Nível da Permissão" required id="permissao" class="gui-input">
											<label for="permissao" class="field-icon"><i class="fa fa-signal"></i></label>
										</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="section">
										<span title="Obrigatório" class="help-block"><i class="fa fa-eye"></i> Ativo <span class="text-danger">*</span></span>
										<label class="field select">
											<select name="ativo" required id="ativo">
												<option value="">SELECIONAR</option>
												<?php echo $this->texto_m->ativo_selecionar($this->login_m->getAtivo()); ?>
											</select>
											<i class="arrow"></i>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="section">
										<span class="help-block">Observação</span>
										<label class="field prepend-icon">
											<textarea name="obs" placeholder="Escreva uma observação" id="obs" class="gui-textarea"><?php echo $this->login_m->getObs(); ?></textarea>
											<label for="obs" class="field-icon"><i class="fa fa-file-text-o"></i></label>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-offset-10 col-md-2">
									<button type="submit" class="btn btn-bordered btn-primary mb5"><span class="fa fa-check"></span> Salvar Edição</button>
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
