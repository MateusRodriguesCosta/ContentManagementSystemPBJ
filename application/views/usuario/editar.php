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
				<li class="breadcrumb-link"><?php echo anchor('Usuario', 'Usuário', 'title="Clique para ir"'); ?></li>
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
						<div class="panel-heading"><div class="panel-title">Editar Usuário</div></div>
						<div class="panel-body">
							<?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>','</strong></div>'); ?>
							<?php echo form_open('Usuario/Update', 'id="form-ui"', array('id'=>$this->usuario_m->getId())); ?>
							<div class="row">
								<div class="col-md-4">
									<div class="section">
										<span title="Obrigatório" class="help-block"><i class="fa fa-eye"></i> Ativo <span class="text-danger">*</span></span>
										<label class="field select">
											<select name="ativo" required id="ativo">
												<option value="">SELECIONAR</option>
												<?php echo $this->texto_m->ativo_selecionar($this->usuario_m->getAtivo()); ?>
											</select>
											<i class="arrow"></i>
										</label>
									</div>
								</div>
								<div class="col-md-8">
									<div class="section">
										<span title="Obrigatório" class="help-block">Nome <span class="text-danger">*</span></span>
										<label class="field prepend-icon">
											<input name="nome" value="<?php echo $this->usuario_m->getNome(); ?>" placeholder="Nome do Usuário" required id="nome" class="gui-input">
											<label for="nome" class="field-icon"><i class="fa fa-user"></i></label>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="section">
										<span title="Obrigatório" class="help-block">E-mail <span class="text-danger">*</span></span>
										<label class="field prepend-icon">
											<input type="email" name="email" value="<?php echo $this->usuario_m->getEmail(); ?>" placeholder="E-mail do Usuário" required id="email" class="gui-input">
											<label for="email" class="field-icon"><i class="fa fa-envelope"></i></label>
										</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="section">
										<span title="Obrigatório" class="help-block">Login <span class="text-danger">*</span></span>
										<label class="field prepend-icon">
											<input name="login" value="<?php echo $this->usuario_m->getLogin(); ?>" placeholder="Login do Usuário" required id="login" class="gui-input">
											<label for="login" class="field-icon"><i class="fa fa-sign-in"></i></label>
										</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-offset-10 col-md-2">
									<button type="submit" class="btn btn-bordered btn-warning mb5 pull-right" onclick="this.disabled = true"><span class="fa fa-check"></span> Salvar Edição</button>
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
