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
                <li class="breadcrumb-current-item">Online</li>
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>

	<section id="content" class="table-layout animated fadeIn">
		<div class="chute chute-center">

			<?php echo $this->texto_m->alerta($this->session->status); ?>

			<div class="panel">
				<div class="panel-heading"><span class="panel-title">Lista de usuários: <?php echo $this->online_m->total(); ?></span></div>
				<div class="panel-menu">
					<input type="text" placeholder="Digite aqui para filtrar..." id="fooFilter" class="form-control">
				</div>
				<div class="panel-body pn">
					<div class="table-responsive">
						<table class="table footable" data-filter="#fooFilter">
							<thead>
								<tr>
									<th>Login</th>
									<th>IP</th>
									<th>HOST</th>
									<th>OS</th>
									<th>Navegador</th>
									<th>Data e Hora</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td><?php echo $row->usu_login; ?></td>
									<td><?php echo $row->onl_ip; ?></td>
									<td><?php echo $row->onl_host; ?></td>
									<td><?php echo $row->onl_os; ?></td>
									<td><?php echo $row->onl_navegador; ?></td>
									<td><?php echo $row->onl_datahora; ?></td>
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
