<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Online_m extends CI_Model {

	private $id;
	private $login;
	private $ip;
	private $host;
	private $os;
	private $navegador;
	private $datahora;

	private function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setIp($ip){
		$this->ip = $ip;
	}

	public function getIp(){
		return $this->ip;
	}

	public function setHost($host){
		$this->host = $host;
	}

	public function getHost(){
		return $this->host;
	}

	public function setOs($os){
		$this->os = $os;
	}

	public function getOs(){
		return $this->os;
	}

	public function setNavegador($navegador){
		$this->navegador = $navegador;
	}

	public function getNavegador(){
		return $this->navegador;
	}

	public function setDatahora($datahora){
		$this->datahora = $datahora;
	}

	public function getDatahora(){
		return $this->datahora;
	}

	public function inserir(){
		$data = array(
			'onl_login' => $this->getLogin(),
			'onl_ip' => $this->getIp(),
			'onl_host' => $this->getHost(),
			'onl_os' => $this->getOs(),
			'onl_navegador' => $this->getNavegador()
		);
		$this->db->insert('pousada_online', $data);
	}

	public function todos(){
		$this->db->select('usu_login, onl_ip, onl_host, onl_os, onl_navegador, onl_datahora');
		$this->db->from('pousada_online');
		$this->db->join('pousada_usuario', 'pousada_usuario.usu_id = pousada_online.onl_login');
		$this->db->order_by('onl_datahora', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function total(){
		return $this->db->count_all('pousada_online');
	}

	public function apagar($login){
		$this->db->where('onl_login', $login);
		$this->db->delete('pousada_online');
	}

	public function apagar_ontem(){
		$this->db->where('onl_datahora <', date('Y-m-d').' 00:00:00');
		$this->db->delete('pousada_online');
	}

	public function online($login){
		$this->db->where('onl_login', $login);
		$this->db->from('pousada_online');
		return $this->db->count_all_results();
	}

	public function lembrar(){
		if(get_cookie('id')<>null && get_cookie('login')<>null && get_cookie('ip')<>null){
			$this->login_m->login2(get_cookie('id'));

			$sessao_user = array(
				'user_id'=>$this->login_m->getId(),
				'user_nome'=>$this->login_m->getNome(),
				'user_login'=>$this->login_m->getLogin(),
				'user_ip'=>$this->texto_m->ip()
			);
			$this->session->set_userdata($sessao_user);

			$this->acesso_m->setUsuario($this->session->user_id);
			$this->acesso_m->setIp($this->texto_m->ip());
			$this->acesso_m->setAcesso(6);
			$this->acesso_m->inserir();

			if($this->online_m->online($this->login_m->getId())<1){

				$this->online_m->setLogin($this->login_m->getId());
				$this->online_m->setIp($this->texto_m->ip());
				$this->online_m->setHost($this->texto_m->host());
				$this->online_m->setOs($this->texto_m->sistema_operacional());
				$this->online_m->setNavegador($this->texto_m->navegador());

				$this->online_m->inserir();
			}

			$cookie = array(
				'name'   => 'id',
				'value'  => $this->login_m->getId(),
				'expire' => '432000'
			);
			$this->input->set_cookie($cookie);

			$cookie = array(
				'name'   => 'login',
				'value'  => $this->login_m->getLogin(),
				'expire' => '432000'
			);
			$this->input->set_cookie($cookie);

			$cookie = array(
				'name'   => 'ip',
				'value'  => $this->texto_m->ip(),
				'expire' => '432000'
			);
			$this->input->set_cookie($cookie);
		}
	}
}
