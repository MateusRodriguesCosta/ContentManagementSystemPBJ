<!-- Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
Confidencial e proprietário
Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017 -->

<section id="content_wrapper">
	<header id="topbar" class="alt">
		<div class="topbar-left">
			<ol class="breadcrumb">
				<li class="breadcrumb-icon"><?php echo anchor('', '<span class="fa fa-home"></span>', 'title="Clique para ir"'); ?></li>
				<li class="breadcrumb-active"><?php echo anchor('', 'MENU PRINCIPAL', 'title="Clique para ir"'); ?></li>
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

<?php
foreach($result as $row){
	error_reporting(0);
?>
	<div class="panel panel-<?php echo $this->texto_m->log_painel($row->log_operacao); ?> panel-border top">
		<div class="panel-heading">
			<div class="widget-menu">
				<code class="mr10 bg-<?php echo $this->texto_m->log_painel($row->log_operacao); ?> dark p3 ph5"><?php echo $this->texto_m->log_texto($row->log_operacao); ?></code>
				<code class="mr10 p3 ph5"><?php echo $row->log_datahora; ?></code>
			</div>
		</div>

		<div class="panel-body">
			<textarea name="decricao" style="width:100%;min-width:100%;max-width:100%;min-height:190px;cursor:default;" readonly><?php echo $this->texto_m->tratarQueryLog($row->log_descricao,'pousada_banner'); ?></textarea>
		</div>

		<div class="panel-footer">
			<div class="widget-menu">
				<code class="mr10 p3 ph5">LOGIN: <?php echo $this->login_m->login_user($row->log_login); ?></code>
				<code class="mr10 p3 ph5">IP: <?php echo $row->log_ip; ?></code>
				<code class="mr10 p3 ph5">HOST: <?php echo $row->log_host; ?></code>
				<code class="mr10 p3 ph5">SISTEMA OPERACIONAL: <?php echo $row->log_os; ?></code>
				<code class="mr10 p3 ph5">NAVEGADOR: <?php echo $row->log_navegador; ?></code>
			</div>
		</div>
	</div>
<?php } ?>

					</div>
				</div>

			</div>
		</div>
	</section>
</section>
