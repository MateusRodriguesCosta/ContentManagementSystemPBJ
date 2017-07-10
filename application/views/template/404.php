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
	</header>

	<section id="content" class="pn animated fadeIn">
		<div class="center-block mt100 mw800 text-center p20">
			<img src="<?php echo base_url('assets/img/404.png" alt="error 404" class="img-responsive mauto'); ?>"/>
			<h2 class="mt40 mb20">A página solicitada não pode ser encontrada</h2>
			<h6>
				Não consegue encontrar o que você precisa?
				<br/>
				Observe a URL e veja se foi digitada corretamente ou volte para à <?php echo anchor('', 'Dashboard', 'title="Clique para ir"'); ?>.
			</h6>
		</div>
	</section>
</section>
