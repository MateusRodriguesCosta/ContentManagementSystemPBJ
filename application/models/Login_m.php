<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {

	private $id;
	private $nome;
	private $login;
	private $senha;
	private $ativo;
	private $datahora;

	private function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	private function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	private function setLogin($login){
		$this->login = $login;
	}

	public function getLogin(){
		return $this->login;
	}

	private function setSenha($senha){
		$this->senha = $senha;
	}

	public function getSenha(){
		return $this->senha;
	}

	private function setAtivo($ativo){
		$this->ativo = $ativo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	private function setDatahora($datahora){
		$this->datahora = $datahora;
	}

	public function getDatahora(){
		return $this->datahora;
	}

	public function login($login, $senha){
		$this->db->select('usu_id, usu_nome, usu_login, usu_ativo');
		$this->db->where('usu_login', $login);
		$this->db->where('usu_senha', $senha);
		$result = $this->db->get('pousada_usuario');
		$result = $result->row();

		$this->setId($result->usu_id);
		$this->setNome($result->usu_nome);
		$this->setLogin($result->usu_login);
		$this->setAtivo($result->usu_ativo);
	}

	public function login2($id){
		$this->db->select('usu_id, usu_nome, usu_login, usu_ativo');
		$this->db->where('usu_id', $id);
		$result = $this->db->get('pousada_usuario');
		$result = $result->row();

		$this->setId($result->usu_id);
		$this->setNome($result->usu_nome);
		$this->setLogin($result->usu_login);
		$this->setAtivo($result->usu_ativo);
	}

	public function login_id($login){
		$this->db->select('usu_id');
		$this->db->where('usu_login', $login);
		$result = $this->db->get('pousada_usuario');
		$result = $result->row();

		return $result->usu_id;
	}

	public function login_ativo($id){
		$this->db->select('usu_ativo');
		$this->db->where('usu_id', $id);
		$result = $this->db->get('pousada_usuario');
		$result = $result->row();
		$na['usu_ativo'] = "mateus";
		//return $result->usu_ativo;
		return $na;
	}

	public function login_user($id){
		$this->db->select('usu_login');
		$this->db->where('usu_id', $id);
		$result = $this->db->get('pousada_usuario');
		$result = $result->row();

		return $result->usu_login;
	}

	public function login_total($login){
		$this->db->select('usu_id');
		$this->db->where('usu_login', $login);
		$this->db->from('pousada_usuario');
		return $this->db->count_all_results();
	}

	public function login_total2($login, $senha){
		$this->db->select('usu_id');
		$this->db->where('usu_login', $login);
		$this->db->where('usu_senha', $senha);
		$this->db->from('pousada_usuario');
		return $this->db->count_all_results();
	}

	public function permitir(){
		if($this->session->user_id == null || $this->session->user_login == null || $this->session->user_ip == null){
			$this->session->set_userdata('status', 'LOGIN_FORA');

			redirect('Login/Entrar');
		}

		if($this->login_m->login_ativo($this->session->user_id)<>'s'){
			$this->session->set_userdata('status', 'LOGIN_DESATIVADO');

			$this->acesso_m->setUsuario($this->session->user_id);
			$this->acesso_m->setIp($this->texto_m->ip());
			$this->acesso_m->setAcesso(8);
			$this->acesso_m->inserir();

			$this->online_m->apagar($this->session->user_id);

			$sessao_user = array(
				'user_id',
				'user_nome',
				'user_login',
				'user_ip'
			);
			$this->session->unset_userdata($sessao_user);

			delete_cookie('id');
			delete_cookie('login');
			delete_cookie('ip');

			redirect('Login/Entrar');
		}

		if($this->ip_m->validar($this->texto_m->ip())<1){
			$this->acesso_m->setUsuario($this->login_m->getId());
			$this->acesso_m->setIp($this->texto_m->ip());
			$this->acesso_m->setAcesso(9);
			$this->acesso_m->inserir();

			$this->session->set_userdata('status', 'LOGIN_IP_MUDOU');
			redirect('Login/Entrar');
		}
	}
}
