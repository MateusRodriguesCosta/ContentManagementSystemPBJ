<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Acesso_m extends CI_Model {

	private $id;
	private $usuario;
	private $ip;
	private $acesso;
	private $datahora;

	private function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setIp($ip){
		$this->ip = $ip;
	}

	public function getIp(){
		return $this->ip;
	}

	public function setAcesso($acesso){
		$this->acesso = $acesso;
	}

	public function getAcesso(){
		return $this->acesso;
	}

	public function setDatahora($datahora){
		$this->datahora = $datahora;
	}

	public function getDatahora(){
		return $this->datahora;
	}

	public function inserir(){
		$data = array(
			'ace_usuario' => $this->getUsuario(),
			'ace_ip' => $this->getIp(),
			'ace_acesso' => $this->getAcesso()
		);
		$this->db->insert('pousada_acesso', $data);
	}

	public function todos(){
		$this->db->order_by('ace_id', 'ASC');
		$query = $this->db->get('poussada_acesso');
		return $query->result();
	}

	public function total(){
		return $this->db->count_all('pousada_acesso');
	}

	public function listar_usuario($usuario){
		$this->db->select('ace_ip, ace_acesso, ace_datahora');
		$this->db->from('pousada_acesso');
		$this->db->where('ace_usuario',$usuario);
		$this->db->order_by('ace_datahora','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_listar_usuario($usuario){
		$this->db->select('ace_id');
		$this->db->from('pousada_acesso');
		$this->db->where('ace_usuario',$usuario);
		return $this->db->count_all_results();
	}
}
