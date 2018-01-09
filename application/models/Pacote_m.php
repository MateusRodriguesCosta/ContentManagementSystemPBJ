<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Pacote_m extends CI_Model {

	private $id;
	private $titulo;
	private $caminho;
	private $regulamentos;
	private $dataInclusao;
	private $dataAlteracao;

	/**
	* Métodos de acesso (Getters/Setters)
	*/

	private function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setCaminho($caminho){
		$this->caminho = $caminho;
	}

	public function getCaminho(){
		return $this->caminho;
	}

	public function setRegulamentos($regulamentos){
		$this->regulamentos = $regulamentos;
	}

	public function getRegulamentos(){
		return $this->regulamentos;
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

	/**
	* Métodos principais - Listar, Totalizar, Buscar, Inserir, Editar e Atualizar.
	*/

	public function listar(){
		$this->db->query('SET lc_time_names = "pt_BR"');
		$this->db->select('pac_id, pac_titulo, date_format(pac_dataInclusao, "%W %d de %M de %Y") as pac_dataInclusao, pac_caminho, date_format(pac_dataAlteracao, "%W %d de %M de %Y") as pac_dataAlteracao');
		$this->db->order_by('pac_id', 'DESC');
		$query = $this->db->get('pousada_pacote');
		return $query->result();
	}

	public function totalizar(){
		return $this->db->count_all('pousada_pacote');
	}

	public function buscar($id){
		$this->db->from('pousada_pacote');
		$this->db->where('pac_id', $id);
		return $this->db->count_all_results();
	}

	public function inserir(){
		$data = array(
			'pac_titulo' => $this->getTitulo(),
			'pac_caminho' => $this->getCaminho(),
			'pac_regulamentos' => $this->getRegulamentos(),
			'pac_dataInclusao' => $this->getDataInclusao(),
			'pac_dataAlteracao' => 'YYYY/mm/dd 00:00:00'
		);

		$this->db->insert('pousada_pacote', $data);
		$this->setId($this->db->insert_id());
		return $this->getId();
	}

	public function editar($id){
		$this->db->query('SET lc_time_names = "pt_BR"');
		$this->db->select('pac_id, pac_caminho, date_format(pac_dataInclusao, "%d/%m/%Y") as pac_dataInclusao, date_format(pac_dataAlteracao, "%d/%m/%Y") as pac_dataAlteracao, pac_id, pac_titulo, pac_regulamentos');
		$this->db->where('pac_id', $id);
		$result = $this->db->get('pousada_pacote');
		$result = $result->row();

		$this->setId($result->pac_id);
		$this->setTitulo($result->pac_titulo);
		$this->setCaminho($result->pac_caminho);
		$this->setRegulamentos($result->pac_regulamentos);
		$this->setDataInclusao($result->pac_dataInclusao);
		$this->setDataAlteracao($result->pac_dataAlteracao);
	}

	public function atualizar(){

		$data = array(
			'pac_titulo' => $this->getTitulo(),
			'pac_caminho' => $this->getCaminho(),
			'pac_regulamentos' => $this->getRegulamentos(),
			'pac_dataAlteracao' => $this->getDataAlteracao()
		);

		$this->db->where('pac_id', $this->getId());
		$this->db->update('pousada_pacote', $data);
	}
}
