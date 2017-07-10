<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct(){
        parent::__construct();

        $this->session->set_userdata('titulo_pagina', 'Configurações/Log');
        $this->session->unset_userdata('css_js');
    }

	public function index(){
		redirect();
	}

	public function show($tabela, $linha){
		if($this->log_m->total_listar($tabela, $linha)<1){

			$this->load->view('template/header');
			$this->load->view('log/vazio');
			$this->load->view('template/footer');
		} else {
			$result = $this->log_m->listar($tabela, $linha);
			$data['result'] = $result;

			$this->load->view('template/header');
			$this->load->view('log/historico',$data);
			$this->load->view('template/footer');
		}
	}
}
