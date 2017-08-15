<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Midia_m extends CI_Model {

	private $id;
	private $titulo;
	private $tipo;
	private $link;
	private $local;
	private $periodo;
	private $caminho;
	private $capacidade;
	private $equipamentos;
	private $descricao;
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

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getLocal(){
		return $this->local;
	}

	public function setLocal($local){
		$this->local = $local;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setLink($link){
		$this->link = $link;
	}

	public function getLink(){
		return $this->link;
	}

	public function setPeriodo($periodo){
		$this->periodo = $periodo;
	}

	public function getPeriodo(){
		return $this->periodo;
	}

	public function setCapacidade($capacidade){
		$this->capacidade = $capacidade;
	}

	public function getCapacidade(){
		return $this->capacidade;
	}

	public function setEquipamentos($equipamentos){
		$this->equipamentos = $equipamentos;
	}

	public function getEquipamentos(){
		return $this->equipamentos;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getDescricao(){
		return $this->descricao;
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
		$query = $this->db->query("SELECT mid_id, mid_tipo, mid_titulo, mid_ativo, date_format(mid_dataInclusao, '%W %d de %M de %Y') as mid_dataInclusao, date_format(mid_dataAlteracao, '%W %d de %M de %Y') as mid_dataAlteracao, mid_local FROM `pousada_midia` as `M` WHERE `mid_tipo` LIKE 'midia' ORDER BY `mid_id` DESC;");
		return $query->result();
	}

	public function retornarId(){
		$this->db->query('SET lc_time_names = "pt_BR"');
		$query = $this->db->query("SELECT mid_id FROM `pousada_midia` as `M` WHERE `mid_tipo` LIKE 'midia' ORDER BY mid_id DESC LIMIT 1;");
		return $query->result();
	}

	public function totalizar(){
		return $this->db->count_all('pousada_midia');
	}

	public function buscar($id){
		$this->db->from('pousada_midia');
		$this->db->where('mid_id', $id);
		return $this->db->count_all_results();
	}

	public function inserir(){
		switch ($this->getLocal()) {
			case 'Página Principal':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_link' => $this->getLink(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataInclusao' => $this->getDataInclusao(),
				'mid_dataAlteracao' => '0000/00/00 00:00:00'
			);
				break;
			case 'A Pousada - Visitas Ilustres':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_periodo' => $this->getPeriodo(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataInclusao' => $this->getDataInclusao(),
				'mid_dataAlteracao' => '0000/00/00 00:00:00'
			);
				break;
			case 'Fé e Lazer - Pousada':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataInclusao' => $this->getDataInclusao(),
				'mid_dataAlteracao' => '0000/00/00 00:00:00'
			);
				break;
			case 'Eventos - Ambientes':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_capacidade' => $this->getCapacidade(),
				'mid_equipamentos' => $this->getEquipamentos(),
				'mid_dataInclusao' => $this->getDataInclusao(),
				'mid_dataAlteracao' => '0000/00/00 00:00:00'
			);
				break;
			case 'Restaurante':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataInclusao' => $this->getDataInclusao(),
				'mid_dataAlteracao' => '0000/00/00 00:00:00'
			);
				break;
			default:
			$data = array(
				'mid_id' => $this->getId(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_link' => $this->getLink(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataInclusao' => $this->getDataInclusao(),
				'mid_dataAlteracao' => '0000/00/00 00:00:00'
			);
			# Banner ou Imagem
				break;
		}

		$this->db->insert('pousada_midia', $data);
		$this->setId($this->db->insert_id());
		return $this->getId();
	}

	public function editar($id){
		$this->db->select('*,date_format(mid_dataInclusao, "%d/%m/%Y") as mid_dataInclusao, date_format(mid_dataAlteracao, "%d/%m/%Y") as mid_dataAlteracao');
		$this->db->where('mid_id', $id);
		$result = $this->db->get('pousada_midia');
		$result = $result->row();

		$this->setId($result->mid_id);
		$this->setTitulo($result->mid_titulo);
		$this->setTipo($result->mid_tipo);
		$this->setLink($result->mid_link);
		$this->setLocal($result->mid_local);
		$this->setCaminho($result->mid_caminho);
		$this->setPeriodo($result->mid_periodo);
		$this->setCapacidade($result->mid_capacidade);
		$this->setEquipamentos($result->mid_equipamentos);
		$this->setDescricao($result->mid_descricao);
		$this->setDataInclusao($result->mid_dataInclusao);
		$this->setDataAlteracao($result->mid_dataAlteracao);
		$this->setAtivo($result->mid_ativo);
	}

	public function atualizar(){

		switch ($this->getLocal()) {
			case 'Página Principal':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_ativo' => $this->getAtivo(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_link' => $this->getLink(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataAlteracao' => $this->getDataAlteracao()
			);
				break;
			case 'A Pousada - Visitas Ilustres':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_ativo' => $this->getAtivo(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_periodo' => $this->getPeriodo(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataAlteracao' => $this->getDataAlteracao()
			);
				break;
			case 'Fé e Lazer - Pousada':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_ativo' => $this->getAtivo(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataAlteracao' => $this->getDataAlteracao()
			);
				break;
			case 'Eventos - Ambientes':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_ativo' => $this->getAtivo(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_capacidade' => $this->getCapacidade(),
				'mid_equipamentos' => $this->getEquipamentos(),
				'mid_dataAlteracao' => $this->getDataAlteracao()
			);
				break;
			case 'Restaurante':
			$data = array(
				'mid_id' => $this->getId(),
				'mid_ativo' => $this->getAtivo(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataAlteracao' => $this->getDataAlteracao()
			);
				break;
			default:
			$data = array(
				'mid_id' => $this->getId(),
				'mid_ativo' => $this->getAtivo(),
				'mid_caminho' => $this->getCaminho(),
				'mid_local' => $this->getLocal(),
				'mid_tipo' => $this->getTipo(),
				'mid_titulo' => $this->getTitulo(),
				'mid_link' => $this->getLink(),
				'mid_descricao' => $this->getDescricao(),
				'mid_dataAlteracao' => $this->getDataAlteracao()
			);
			# Banner ou Imagem
				break;
		}

		$this->db->where('mid_id', $this->getId());
		$this->db->update('pousada_midia', $data);
		return $this->getId();
	}

}
