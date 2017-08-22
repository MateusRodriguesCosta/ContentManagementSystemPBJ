<!-- Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
Confidencial e proprietário
Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017 -->

<div id="main" class="animated fadeIn">
	<section id="content_wrapper">
		<div id="canvas-wrapper"><canvas id="demo-canvas"></canvas></div>
		<section id="content">
			<div class="allcp-form theme-primary mw320" id="login">
				<div class="text-center mb20"><img src="<?php echo base_url('assets/img/patterns/login/placa.png'); ?>" class="img-responsive" alt="Logo"/></div>
				<div class="allcp-form">
					<div class="panel mw320">
						<?php echo $this->texto_m->alerta($this->session->status); ?>
						<?php echo validation_errors($this->texto_m->alerta('FORM_ERROR'),'</strong></div>'); ?>
						<?php echo form_open('Login/Validar', 'id="form-login"'); ?>
						<div class="panel-body pn mv10">
							<div class="section">
								<label for="login" class="field prepend-icon">
									<input type="text" name="login" value="<?php echo set_value('login'); ?>" placeholder="Login" id="login" class="gui-input">
									<label for="login" class="field-icon"><i class="fa fa-user"></i></label>
								</label>
							</div>
							<div class="section">
								<label for="senha" class="field prepend-icon">
									<input type="password" name="senha" value="" placeholder="Senha" id="senha" class="gui-input">
									<label for="senha" class="field-icon"><i class="fa fa-lock"></i></label>
								</label>
							</div>
							<div class="section">
								<button type="submit" class="btn btn-bordered btn-warning pull-right">Entrar</button>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</section>
	</section>
