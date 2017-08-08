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
                <li class="breadcrumb-current-item">Listar</li>
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>

	<section id="content" class="table-layout animated fadeIn">
		<div class="chute chute-center">

			<?php echo $this->texto_m->alerta($this->session->status); ?>

			<div class="panel">
				<div class="panel-heading"><span class="panel-title">Lista de usuários: <?php echo $this->usuario_m->total(); ?></span></div>
				<div class="panel-menu">
					<input type="text" placeholder="Digite aqui para filtrar resultados..." id="fooFilter" class="form-control gui-input">
				</div>
				<div class="panel-body pn">
					<div class="table-responsive">
						<table class="table footable" data-filter="#fooFilter">
							<thead>
								<tr>
									<th>Login</th>
									<th>Ativo</th>
									<th>Cadastrado</th>
									<th>Operações</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($result as $row){ ?>
								<tr>
									<td><?php echo $row->usu_login; ?></td>
									<td><?php echo $this->texto_m->ativo_icone($row->usu_ativo); ?><span class="invisivel"><?php echo $row->usu_ativo; ?></span></td>
									<td><?php echo $row->usu_datahora; ?></td>
									<td class="operacoes">
										<?php echo anchor('Usuario/Show/'.$row->usu_id, '<i class="fa fa-eye icon-clickable-pbj"></i>', 'title="Clique para ver"'); ?>
										<?php echo anchor('Usuario/Editar/'.$row->usu_id, '<i class="fa fa-pencil-square-o icon-clickable-pbj"></i>', 'title="Clique para editar"'); ?>
										<?php echo anchor('Usuario/Senha/'.$row->usu_id, '<i class="fa fa-unlock icon-clickable-pbj"></i>', 'title="Clique para alterar senha"'); ?>
										<?php echo anchor('Usuario/Acesso/'.$row->usu_id, '<i class="fa fa-sign-in icon-clickable-pbj"></i>', 'title="Clique para ir ver acessos"'); ?>
										<?php echo anchor('Log/Show/Usuario/'.$row->usu_id, '<i class="glyphicon glyphicon-hdd icon-clickable-pbj"></i>', 'title="Clique para ir ver o histórico"'); ?>
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
