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
				<?php echo $this->texto_m->alerta($this->session->status); ?>
				<div class="allcp-form">
					<div class="panel">
						<div class="panel-heading"><div class="panel-title">Editar Senha</div></div>
						<div class="panel-body">
							<?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>','</strong></div>'); ?>
							<?php echo form_open('Login/Senha_Update', 'id="form-ui"', array('id'=>$this->login_m->getColaborador())); ?>
								<div class="row">
									<div class="col-md-6">
										<div class="section">
											<span class="help-block">Senha <span class="text-danger">*</span></span>
											<label class="field prepend-icon">
												<input type="password" name="senha" value="<?php echo set_value('senha'); ?>" placeholder="Senha do login" required id="senha" class="gui-input">
												<label for="senha" class="field-icon"><i class="fa fa-unlock"></i></label>
											</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="section">
											<span class="help-block">Confirmar Senha <span class="text-danger">*</span></span>
											<label class="field prepend-icon">
												<input type="password" name="senha_n" value="<?php echo set_value('senha_n'); ?>" placeholder="Senha do login novamente" required id="senha_n" class="gui-input">
												<label for="senha_n" class="field-icon"><i class="fa fa-unlock"></i></label>
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
