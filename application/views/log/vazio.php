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
				<li class="breadcrumb-link"><?php echo anchor('', 'Configura&ccedil;&otilde;es', 'title="Clique para ir"'); ?></li>
                <li class="breadcrumb-current-item">Log (Histórico)</li>
			</ol>
		</div>
		<div class="topbar-right"></div>
	</header>

	<section id="content" class="table-layout animated fadeIn">
		<div class="chute chute-center">
			<div class="mw1500 center-block">

				<div class="row">
					<div class="col-md-12">

<div class="panel panel-dark panel-border top">
    <div class="panel-heading">
        <div class="widget-menu">
            <code class="mr10 bg-dark dark p3 ph5">Não houve operação</code>
        </div>
    </div>

    <div class="panel-body">
        <p>Não tem registros no histórico de log do sistema, deve ser inserido via base de dados ou antes do sistema de log ser criado.</p>
    </div>
</div>

					</div>
				</div>

			</div>
		</div>
	</section>
</section>
