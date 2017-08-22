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
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>
	<section id="content" class="animated fadeIn">
		<?php echo $this->texto_m->alerta($this->session->status); ?>
		<div class="row mb10">
			<div class="col-sm-6 col-md-6">
				<div class="bs-component">
					<div class="panel panel-tile br-b bw5 br-default-light">
						<div class="panel-body pl20 p5">
							<a href="http://www.pousadadobomjesus.com" title="Clique para ir" target="_blank" class="text-pbj"><i class="imoon imoon-globe icon-bg"></i></a>
							<a href="http://www.pousadadobomjesus.com" title="Clique para ir" target="_blank" class="mt15 lh15 text-pbj"><b>Pousada do Bom Jesus</b></a>
							<h5 class="text-muted"><b>Site</b></h5>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="bs-component">
					<div class="panel panel-tile br-b bw5 br-default-light">
						<div class="panel-body pl20 p5">
							<a href="http://webmail.pousadadobomjesus.com" title="Clique para ir" target="_blank" class="text-pbj"><i class="imoon imoon-envelop icon-bg"></i></a>
							<a href="http://webmail.pousadadobomjesus.com" title="Clique para ir" target="_blank" class="mt15 lh15 text-pbj"><b>Pousada do Bom Jesus</b></a>
							<h5 class="text-muted">WebMail</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb10">
			<div class="col-sm-6 col-md-6">
				<div class="bs-component">
					<div class="panel panel-tile br-b bw5 br-default-light">
						<div class="panel-body pl20 p5">
							<a href="Banner/Listar" title="Clique para ir"  class="text-pbj"><i class="imoon imoon-paint-format icon-bg"></i></a>
							<?php echo anchor('Banner/Listar', '<b>Lista de Banners</b>', 'title="Clique para ir" class="mt15 lh15 text-pbj"'); ?>
							<h5 class="text-muted">Banner</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="bs-component">
					<div class="panel panel-tile br-b bw5 br-default-light">
						<div class="panel-body pl20 p5">
							<a href="Imagem/Listar" title="Clique para ir"  class="text-pbj"><i class="imoon imoon-images icon-bg"></i></a>
							<?php echo anchor('Imagem/Listar', '<b>Lista de Imagens</b>', 'title="Clique para ir" class="mt15 lh15 text-pbj"'); ?>
							<h5 class="text-muted">Imagem</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb10">
			<div class="col-sm-6 col-md-6">
				<div class="bs-component">
					<div class="panel panel-tile br-b bw5 br-default-light">
						<div class="panel-body pl20 p5">
							<a href="Midia/Listar" title="Clique para ir"  class="text-pbj"><i class="imoon imoon-newspaper icon-bg"></i></a>
							<?php echo anchor('Midia/Listar', '<b>Lista de Mídias</b>', 'title="Clique para ir" class="mt15 lh15 text-pbj"'); ?>
							<h5 class="text-muted">Mídia</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="bs-component">
					<div class="panel panel-tile br-b bw5 br-default-light">
						<div class="panel-body pl20 p5">
							<a href="Usuario/Listar" title="Clique para ir"  class="text-pbj"><i class="imoon imoon-user icon-bg"></i></a>
							<?php echo anchor('Usuario/Listar', '<b>Lista de Usuários</b>', 'title="Clique para ir" class="mt15 lh15 text-pbj"'); ?>
							<h5 class="text-muted">Usuário</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
