<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Ip extends CI_Controller {

	public function index($ip){

		if($ip){
			$this->ip_m->setIp($ip);
			$this->ip_m->inserir();

			$this->session->set_userdata('status', 'IP_NOVO_LOCAL');
			redirect('Login/Entrar');
		} else {
			redirect('Login/Entrar');
		}

	}

	public function meu_ip(){
		$this->ip_m->setIp($this->texto_m->ip());
		$this->ip_m->inserir();

		$this->session->set_userdata('status', 'IP_NOVO_LOCAL');
		redirect('Login/Entrar');
	}

}
