<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Ip_m extends CI_Model {

	private $id;
	private $ip;
	private $datahora;
	private $ativo;

	private function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setIp($ip){
		$this->ip = $ip;
	}

	public function getIp(){
		return $this->ip;
	}

	public function setDatahora($datahora){
		$this->datahora = $datahora;
	}

	public function getDatahora(){
		return $this->datahora;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	public function inserir(){
		$data = array(
			'ips_ip' => $this->getIp()
		);

		$this->db->insert('pousada_ips', $data);
		$this->setId($this->db->insert_id());

		$this->log_m->setTabela('pousada_ips');
		$this->log_m->setLinha($this->getId());
		$this->log_m->setOperacao('i');
		$this->log_m->setDescricao($this->db->last_query());
		$this->log_m->inserir();
	}

	public function todos(){
		$this->db->order_by('ips_id', 'ASC');
		$query = $this->db->get('pousada_ips');
		return $query->result();
	}

	public function total(){
		return $this->db->count_all('pousada_ips');
	}

	public function validar($ip){
		$this->db->from('pousada_ips');
		$this->db->where('ips_ip',$ip);
		return $this->db->count_all_results();
	}
}
