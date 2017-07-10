<!-- Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
Confidencial e proprietário
Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017 -->

<section id="content_wrapper">
	<header id="topbar" class="alt">
		<div class="topbar-left">
			<ol class="breadcrumb">
				<li class="breadcrumb-icon"><?php echo anchor('', '<span class="fa fa-home"></span>', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-active"><?php echo anchor('', 'Dashboard', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-link"><?php echo anchor('', 'ArqCentral', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-link"><?php echo anchor('', 'Configura&ccedil;&otilde;es', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-link"><?php echo anchor('Login', 'Login', 'title="Clique para ir"'); ?></li>
                <li class="breadcrumb-current-item">Listar</li>
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>

	<section id="content" class="table-layout animated fadeIn">
		<div class="chute chute-center">

			<?php echo $this->texto_m->alerta($this->session->status); ?>

			<div class="panel">
				<div class="panel-heading"><span class="panel-title">Lista de logins: <?php echo $this->login_m->total(); ?></span></div>
				<div class="panel-menu">
					<input type="text" placeholder="Digite aqui para filtrar..." id="fooFilter" class="form-control">
				</div>
				<div class="panel-body pn">
					<div class="table-responsive">
						<table class="table footable" data-filter="#fooFilter">
							<thead>
								<tr>
									<th class="hidden-xs"># ID</th>
									<th>Colaborador</th>
									<th>Login</th>
									<th>Permissão</th>
									<th>Obs</th>
									<th>Ativo</th>
									<th>Opera&ccedil;&otilde;es</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td class="hidden-xs"><?php echo $row->log_colaborador; ?></td>
									<td><?php echo $row->col_colaborador; ?></td>
									<td><?php echo $row->log_login; ?></td>
									<td><?php echo $row->log_permissao; ?></td>
									<td><?php echo $row->log_obs; ?></td>
									<td><?php echo $this->texto_m->ativo_icone($row->log_ativo); ?><span class="invisivel"><?php echo $row->log_ativo; ?></span></td>
									<td class="operacoes">
										<?php echo anchor('Login/Editar/'.$row->log_colaborador, '<i class="fa fa-pencil-square-o"></i>', 'title="Clique para ir editar"'); ?>
										<?php echo anchor('Login/Senha/'.$row->log_colaborador, '<i class="fa fa-unlock"></i>', 'title="Clique para ir editar a senha"'); ?>
										<?php echo anchor('Log/Show/Login/'.$row->log_colaborador, '<i class="glyphicon glyphicon-hdd "></i>', 'title="Clique para ir ver o histórico"'); ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</section>

</section>
