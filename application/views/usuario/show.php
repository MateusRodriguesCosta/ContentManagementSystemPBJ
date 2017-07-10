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
                <li class="breadcrumb-current-item">Show</li>
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>

	<section id="content" class="table-layout animated fadeIn">
		<div class="chute chute-center">
			<div class="panel panel-default panel-border top">
				<div class="panel-heading"><span class="panel-title">Detalhes Sobre a Conta do Usuário</span></div>
				<div class="panel-body">
					<p class="p1"><strong>Nome:</strong> <?php echo $this->usuario_m->getNome(); ?></p>
					<p class="p2"><strong>E-mail:</strong> <?php if($this->usuario_m->getEmail()){echo '<a href="mailto:'.$this->usuario_m->getEmail().'" title="Clique para enviar um e-mail">'.$this->usuario_m->getEmail().'</a>';} ?></p>
					<p class="p2"><strong>Login:</strong> <?php echo $this->usuario_m->getLogin(); ?></p>
					<p class="p2"><strong>Ativo:</strong> <?php echo $this->texto_m->ativo_icone($this->usuario_m->getAtivo()); ?></p>
					<p class="p2"><strong>Cadastrado em:</strong> <?php echo $this->usuario_m->getDatahora(); ?></p>
				</div>
			</div>
		</div>
	</section>
</section>
