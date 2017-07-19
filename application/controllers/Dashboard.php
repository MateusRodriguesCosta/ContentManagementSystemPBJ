<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

        $this->online_m->lembrar();
        $this->login_m->permitir();

        $this->session->set_userdata('titulo_pagina', 'Dashboard');
        $this->session->unset_userdata('css_js');
    }

	public function index(){
		$this->load->view('template/header');
		$this->load->view('dashboard/dashboard');
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}

	public function error_404(){
		$this->load->view('template/header');
		$this->load->view('template/404');
		$this->load->view('template/footer');
	}
}
