<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Log_m extends CI_Model {

	private $id;
	private $tabela;
	private $linha;
	private $operacao;
	private $descricao;
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

	public function setTabela($tabela){
		$this->tabela = $tabela;
	}

	public function getTabela(){
		return $this->tabela;
	}

	public function setLinha($linha){
		$this->linha = $linha;
	}

	public function getLinha(){
		return $this->linha;
	}

	public function setOperacao($operacao){
		$this->operacao = $operacao;
	}

	public function getOperacao(){
		return $this->operacao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getDescricao(){
		return $this->descricao;
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
			'log_tabela' => $this->getTabela(),
			'log_linha' => $this->getLinha(),
			'log_operacao' => $this->getOperacao(),
			'log_descricao' => $this->getDescricao(),
			'log_login' => $this->session->user_id,
			'log_ip' => $this->texto_m->ip(),
			'log_host' => $this->texto_m->host(),
			'log_os' => $this->texto_m->sistema_operacional(),
			'log_navegador' => $this->texto_m->navegador()
		);

		$this->db->insert('pousada_log', $data);
	}

	public function listar($tabela, $linha){
		$this->db->select('log_operacao, log_descricao, log_login, log_ip, log_host, log_os, log_navegador, log_datahora');
		$this->db->from('pousada_log');
		$this->db->like('log_tabela',$tabela);
		$this->db->where('log_linha',$linha);
		$this->db->order_by('log_datahora', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function total_listar($tabela, $linha){
		$this->db->select('log_operacao, log_descricao, log_login, log_ip, log_host, log_os, log_navegador, log_datahora');
		$this->db->from('pousada_log');
		$this->db->like('log_tabela',$tabela);
		$this->db->where('log_linha',$linha);
		return $this->db->count_all_results();
	}
}
