<!-- Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
Confidencial e proprietário
Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017 -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->session->titulo_pagina; ?> - Painel PBJ</title>
	<meta name="keywords" content="Painel Pousada, Pousada do Bom Jesus, pousadadobomjesus.com"/>
	<meta name="application-name" content="Painel Pousada">
	<meta name="description" content="Painel Pousada - Sistema administração do site pousadadobomjesus.com.">
	<meta name="author" content="Mateus Costa <mateusespindola25@hotmail.com>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic">
<?php if($this->session->css_js == 'tabela'){ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/plugins/footable/css/footable.core.min.css'); ?>">
<?php } ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts/iconsweets/iconsweets.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/skin/default_skin/css/theme.css'); ?>">
<?php if($this->session->css_js == 'formulario' || $this->session->css_js == 'entrar' || $this->session->css_js == 'timeline'){ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/allcp/forms/css/forms.css'); ?>">
<?php } ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts/icomoon/icomoon.css'); ?>">
	<link rel="shortcut icon" href="<?php echo base_url('assets/img/patterns/logo/pousada.ico'); ?>">
<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/arqcentral.css'); ?>">
</head>
<?php if($this->session->css_js == 'tabela'){ ?>
<body class="tables-sortable sb-l-m">
<?php } else if($this->session->css_js == 'formulario'){ ?>
<body class="forms-elements sb-l-m">
<?php } else if($this->session->css_js == 'entrar') { ?>
<body class="utility-page sb-l-c sb-r-c sb-l-m">
<?php } else { ?>
<body class="sb-l-o sb-l-m">
<?php } ?>
<?php if($this->session->css_js <> 'entrar'){ ?>
<div id="main">
	<div id="preloader"><span class="loader" data-loading-text="Aguarde, carregando..."></span></div>

    <header class="navbar navbar-fixed-top bg-warning">
        <div class="navbar-logo-wrapper bgc-light dark bg-warning">
            <?php echo anchor('', '<b>Painel Pousada</b>', 'title="Clique para ir" class="navbar-logo-text"'); ?>
            <span id="sidebar_left_toggle" class="ad ad-lines"></span>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="hidden-xs">
                <a class="navbar-fullscreen toggle-active" href="javascript:void(0);">
                    <span class="glyphicon glyphicon-fullscreen"></span>
                </a>
            </li>
<?php if($this->login_m->login_ativo($this->session->user_id)=='s'){ ?>
            <li class="dropdown dropdown-fuse">
                <a href="javascript:void(0);" class="dropdown-toggle fw600" data-toggle="dropdown">
                    <span class="hidden-xs"><name><?php echo $this->session->user_nome; ?></name></span>
                    <span class="fa fa-caret-down hidden-xs mr15"></span>
                </a>
                <ul class="dropdown-menu list-group keep-dropdown w250" role="menu">
                    <li class="list-group-item">
						<?php echo anchor('Colaborador/Editar/'.$this->session->user_id, '<span class="fa fa-male"></span> '.$this->session->user_nome, 'title="Clique para ir" class="animated animated-short fadeInUp"'); ?>
                    </li>
                    <li class="list-group-item">
						<?php echo anchor('Login/Editar/'.$this->session->user_id, '<span class="fa fa-user"></span> '.$this->session->user_login, 'title="Clique para ir" class="animated animated-short fadeInUp"'); ?>
                    </li>
                    <li class="list-group-item">
						<?php echo anchor('Login/Senha/'.$this->session->user_id, '<span class="fa fa-unlock"></span> Alterar Senha', 'title="Clique para ir" class="animated animated-short fadeInUp"'); ?>
                    </li>
                    <li class="dropdown-footer text-center">
						<?php echo anchor('Login/Sair', '<span class="fa fa-power-off pr5"></span> Logout', 'title="Clique para ir" class="btn btn-primary btn-sm btn-bordered"'); ?>
                    </li>
                </ul>
			</li>
<?php } else { ?>
            <li class="dropdown dropdown-fuse"><?php echo anchor('Login/Entrar', '<name>Login (Entrar)</name>', 'title="Clique para ir"'); ?></li>
<?php } ?>
        </ul>
    </header>
<?php
$this->load->view('template/menu-lateral');
}
?>
