<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Imagem_m extends CI_Model {

	private $id;
	private $caminho;
	private $dataInclusao;
	private $dataAlteracao;
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
		$this->db->select('img_id, img_ativo, date_format(img_dataInclusao, "%W %d de %M de %Y") as img_dataInclusao, date_format(img_dataAlteracao, "%W %d de %M de %Y") as img_dataAlteracao, img_caminho, mid_titulo, mid_local');
		$this->db->join('pousada_midia', 'pousada_midia.mid_id = pousada_imagem.img_mid_id');
		$this->db->order_by('img_id', 'DESC');
		$query = $this->db->get('pousada_imagem');
		return $query->result();
	}

	public function totalizar(){
		return $this->db->count_all('pousada_imagem');
	}

	public function buscar($id){
		$this->db->from('pousada_imagem');
		$this->db->where('img_id', $id);
		return $this->db->count_all_results();
	}

	public function inserir($img_mid_id){
		$data = array(
			'img_caminho' => $this->getCaminho(),
			'img_dataInclusao' => $this->getDataInclusao(),
			'img_dataAlteracao' => 'YYYY/mm/dd 00:00:00',
			'img_mid_id' => $img_mid_id
		);

		$this->db->insert('pousada_imagem', $data);
		$this->setId($this->db->insert_id());
		return $this->getId();
	}

	public function editar($id){
		$this->db->query('SET lc_time_names = "pt_BR"');
		$this->db->select('img_id, img_caminho, img_ativo, date_format(img_dataInclusao, "%d/%m/%Y") as img_dataInclusao, date_format(img_dataAlteracao, "%d/%m/%Y") as img_dataAlteracao, mid_id, mid_titulo, mid_link');
		$this->db->join('pousada_midia', 'pousada_midia.mid_id = pousada_imagem.img_mid_id');
		$this->db->where('img_id', $id);
		$result = $this->db->get('pousada_imagem');
		$result = $result->row();

		$this->setId($result->img_id);
		$this->setCaminho($result->img_caminho);
		$this->setAtivo($result->img_ativo);
		$this->setDataInclusao($result->img_dataInclusao);
		$this->setDataAlteracao($result->img_dataAlteracao);
		$this->midia_m->editar($result->mid_id);
	}

	public function atualizar(){
		$data = array(
			'img_dataAlteracao' => $this->getDataAlteracao(),
			'img_ativo' => $this->getAtivo()
		);

		$this->db->where('img_id', $this->getId());
		$this->db->update('pousada_imagem', $data);
	}

}
