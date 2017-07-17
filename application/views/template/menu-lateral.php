<!-- Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
Confidencial e proprietário
Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017 -->

<aside id="sidebar_left" class="nano nano-light sidebar-light">
	<div class="sidebar-left-content nano-content">

		<ul class="nav sidebar-menu">
			<li class="sidebar-label pt30">Menu</li>
			<li><?php echo anchor('', '<span class="imoon imoon-home3 "></span><span class="sidebar-title">Menu Principal</span>', 'title="Clique para ir"'); ?></li>
			<li><a href="http://www.pousadadobomjesus.com" target="_blank"><span class="imoon imoon-globe"></span><span class="sidebar-title">Site da Pousada</span></a></li>
			<li><a href="http://webmail.pousadadobomjesus.com" target="_blank"><span class="imoon imoon-envelop"></span><span class="sidebar-title">E-mail da Pousada</span></a></li>
			<li>
				<a class="accordion-toggle" href="javascript:void(0);">
					<span class="imoon imoon-paint-format"></span>
					<span class="sidebar-title" style="cursor:default;">Banners</span>
					<span class="caret"></span>
				</a>
				<ul class="nav sub-nav">
					<li><?php echo anchor('Banner/Listar', 'Listar', 'title="Listar todas às informações cadastradas"'); ?></li>
					<li><?php echo anchor('Banner/Adicionar', 'Adicionar', 'title="Inserir um novo item"'); ?></li>
				</ul>
			</li>
			<li>
				<a class="accordion-toggle" href="javascript:void(0);">
					<span class="imoon imoon-images"></span>
					<span class="sidebar-title" style="cursor:default;">Imagens</span>
					<span class="caret"></span>
				</a>
				<ul class="nav sub-nav">
					<li><?php echo anchor('Imagem/Listar', 'Listar', 'title="Listar todas às informações cadastradas"'); ?></li>
					<li><?php echo anchor('Imagem/Adicionar', 'Adicionar', 'title="Inserir um novo item"'); ?></li>
				</ul>
			</li>
			<li>
				<a class="accordion-toggle" href="javascript:void(0);">
					<span class="imoon imoon-newspaper"></span>
					<span class="sidebar-title" style="cursor:default;">Mídias</span>
					<span class="caret"></span>
				</a>
				<ul class="nav sub-nav">
					<li><?php echo anchor('Midia/Listar', 'Listar', 'title="Listar todas às informações cadastradas"'); ?></li>
					<li><?php echo anchor('Midia/Adicionar', 'Adicionar', 'title="Inserir um novo item"'); ?></li>
				</ul>
			</li>
			<li>
				<a class="accordion-toggle" href="javascript:void(0);">
					<span class="imoon imoon-user"></span>
					<span class="sidebar-title" style="cursor:default;">Usuário</span>
					<span class="caret"></span>
				</a>
				<ul class="nav sub-nav">
					<li><?php echo anchor('Usuario/Listar', 'Listar', 'title="Listar todas às informações cadastradas"'); ?></li>
					<li><?php echo anchor('Usuario/Adicionar', 'Adicionar', 'title="Inserir um novo item"'); ?></li>
					<li><?php echo anchor('Usuario/Online', 'Online', 'title="Listar todas"'); ?></li>
				</ul>
			</li>
		</ul>

		<div class="sidebar-toggler"><a href="javascript:void(0);"><span class="fa fa-arrow-circle-o-left"></span></a></div>

	</div>
</aside>
