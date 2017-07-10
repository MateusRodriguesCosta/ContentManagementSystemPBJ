<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Banner_m extends CI_Model {

	private $id;
	private $caminho;
	private $dataInclusao;
	private $dataAlteracao;
	private $dataExpiracao;
	private $ativo;

	/**
	 * Métodos de acesso (Getters/Setters)
	 */

	private function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setCaminho($caminho){
		$this->caminho = $caminho;
	}

	public function getCaminho(){
		return $this->caminho;
	}

	public function setDataInclusao($data){
		$this->dataInclusao = $data;
	}

	public function getDataInclusao(){
		return $this->dataInclusao;
	}

	public function setDataAlteracao($data){
		$this->dataAlteracao = $data;
	}

	public function getDataAlteracao(){
		return $this->dataAlteracao;
	}

	public function setDataExpiracao($data){
		$this->dataExpiracao = $data;
	}

	public function getDataExpiracao(){
		return $this->dataExpiracao;
	}

	public function setAtivo($ativo){
		$this->ativo = $ativo;
	}

	public function getAtivo(){
		return $this->ativo;
	}

	/**
	 * Métodos principais - Listar, Totalizar, Buscar, Inserir, Editar e Atualizar.
	 */

	public function listar(){
		$this->db->query('SET lc_time_names = "pt_BR"');
		$this->db->select('ban_id, ban_ativo, mid_titulo, date_format(ban_dataInclusao, "%W %d de %M de %Y") as ban_dataInclusao, date_format(ban_dataAlteracao, "%W %d de %M de %Y") as ban_dataAlteracao, ban_caminho, date_format(ban_dataExpiracao, "%W %d de %M de %Y") as ban_dataExpiracao');
		$this->db->join('pousada_midia', 'pousada_midia.mid_id = pousada_banner.ban_mid_id');
		//$this->db->order_by('ban_show', 'DESC');
		//$this->db->order_by('ban_titulo', 'ASC');
		$query = $this->db->get('pousada_banner');
		return $query->result();
	}

	public function totalizar(){
		return $this->db->count_all('pousada_banner');
	}

	public function buscar($id){
		$this->db->from('pousada_banner');
		$this->db->where('ban_id', $id);
		return $this->db->count_all_results();
	}

	public function inserir($ban_mid_id){
		# Inserir novos atributos POST das Globals
		$data = array(
			'ban_caminho' => $this->getCaminho(),
			'ban_dataInclusao' => $this->getDataInclusao(),
			'ban_dataAlteracao' => 'YYYY/mm/dd 00:00:00',
			'ban_dataExpiracao' => $this->getDataExpiracao(),
			'ban_mid_id' => $ban_mid_id
		);

		$this->db->insert('pousada_banner', $data);

		$this->setId($this->db->insert_id());

		/*$this->log_m->setTabela('pousada_banner');
		$this->log_m->setLinha($this->getId());
		$this->log_m->setOperacao('i');
		$this->log_m->setDescricao($this->db->last_query());
		$this->log_m->inserir();*/
	}

	public function editar($id){
		$this->db->query('SET lc_time_names = "pt_BR"');
		$this->db->select('ban_id, ban_caminho, ban_ativo, date_format(ban_dataInclusao, "%d/%m/%Y") as ban_dataInclusao, date_format(ban_dataExpiracao, "%d/%m/%Y") as ban_dataExpiracao, date_format(ban_dataAlteracao, "%d/%m/%Y") as ban_dataAlteracao, mid_id, mid_titulo, mid_link');
		$this->db->join('pousada_midia', 'pousada_midia.mid_id = pousada_banner.ban_mid_id');
		$this->db->where('ban_id', $id);
		$result = $this->db->get('pousada_banner');
		$result = $result->row();

		$this->setId($result->ban_id);
		$this->setCaminho($result->ban_caminho);
		$this->setAtivo($result->ban_ativo);
		$this->setDataInclusao($result->ban_dataInclusao);
		$this->setDataExpiracao($result->ban_dataExpiracao);
		$this->setDataAlteracao($result->ban_dataAlteracao);
		$this->midia_m->editar($result->mid_id);
	}

	public function atualizar(){

		$data = array(
			'ban_dataInclusao' => $this->getDataInclusao(),
			'ban_dataAlteracao' => $this->getDataAlteracao(),
			'ban_dataExpiracao' => $this->getDataExpiracao(),
			'ban_ativo' => $this->getAtivo()
		);

		$this->db->where('ban_id', $this->getId());
		$this->db->update('pousada_banner', $data);

		/*$this->log_m->setTabela('pousada_banner');
		$this->log_m->setLinha($this->getId());
		$this->log_m->setOperacao('u');
		$this->log_m->setDescricao($this->db->last_query());
		$this->log_m->inserir();*/
	}
}
