<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario_m extends CI_Model {

	private $id;
	private $nome;
	private $email;
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

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function setDatahora($datahora){
		$this->datahora = $datahora;
	}

	public function getDatahora(){
		return $this->datahora;
	}

	public function inserir(){
		$this->setId(substr(md5(uniqid(time())), 0, 5));

		$data = array(
			'usu_id' => $this->getId(),
			'usu_nome' => $this->getNome(),
			'usu_email' => $this->getEmail(),
			'usu_login' => $this->getLogin(),
			'usu_senha' => $this->getSenha()
		);

		$this->db->insert('pousada_usuario', $data);

		$this->log_m->setTabela('pousada_usuario');
		$this->log_m->setLinha($this->getId());
		$this->log_m->setOperacao('i');
		$this->log_m->setDescricao($this->db->last_query());
		$this->log_m->inserir();
	}

	public function todos(){
		$this->db->select('usu_id, usu_login, usu_ativo, usu_datahora');
		$this->db->order_by('usu_datahora', 'DESC');
		$query = $this->db->get('pousada_usuario');
		return $query->result();
	}

	public function total(){
		return $this->db->count_all('pousada_usuario');
	}

	public function editar($id){
		$this->db->where('usu_id', $id);
		$result = $this->db->get('pousada_usuario');
		$result = $result->row();

		$this->setId($result->usu_id);
		$this->setNome($result->usu_nome);
		$this->setEmail($result->usu_email);
		$this->setLogin($result->usu_login);
		$this->setAtivo($result->usu_ativo);
		$this->setDatahora($result->usu_datahora);
	}

	public function update(){
		$data = array(
			'usu_nome' => $this->getNome(),
			'usu_email' => $this->getEmail(),
			'usu_login' => $this->getLogin(),
			'usu_ativo' => $this->getAtivo()
		);

		$this->db->where('usu_id', $this->getId());
		$this->db->update('pousada_usuario', $data);

		$this->log_m->setTabela('pousada_usuario');
		$this->log_m->setLinha($this->getId());
		$this->log_m->setOperacao('u');
		$this->log_m->setDescricao($this->db->last_query());
		$this->log_m->inserir();
	}

	public function update_senha(){
		$data = array(
			'usu_senha' => $this->getSenha()
		);

		$this->db->where('usu_id', $this->getId());
		$this->db->update('pousada_usuario', $data);

		$this->log_m->setTabela('pousada_usuario');
		$this->log_m->setLinha($this->getId());
		$this->log_m->setOperacao('u');
		$this->log_m->setDescricao($this->db->last_query());
		$this->log_m->inserir();
	}
}
