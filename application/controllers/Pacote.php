<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Pacote extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->login_m->permitir();

		$this->session->set_userdata('titulo_pagina', 'Pacote');
		$this->session->unset_userdata('css_js');

		$this->load->model('pacote_m');
		$this->load->model('midia_m');
	}

	public function index(){
		redirect('Pacote/Listar');
	}

	/*Função na qual irá redirecionar para
	* a inclusão de um novo pacote.
	*/
	public function adicionar(){
		$this->session->set_userdata('css_js', 'formulario');
		$this->load->view('template/header');
		$this->load->view('pacote/cadastrar');
		$this->load->view('template/footer');
	}

	/*Função na qual realiza a validação das imagens de
	* apresentação , utilizando como callback do form_validation.
	*/
	public function validarImagem($img,$type){
		if ($type == 'inserir') {
			$config['upload_path']   = "assets/img/pousada_pacote";
			$config['allowed_types'] = 'jpg|png';
			$config['max_width'] = 2049; $config['max_height'] = 1556;
			$config['min_width'] = 300; $config['min_height'] = 300;
			$config['overwrite'] = true;
			$config['file_name'] = 'pacote_'.($this->db->count_all('pousada_pacote') + 1).'.png';
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload('file');
		} elseif($img) {
			$config['upload_path']   = "assets/img/pousada_pacote";
			$config['allowed_types'] = 'jpg|png';
			$config['max_width'] = 2049; $config['max_height'] = 1556;
			$config['min_width'] = 300; $config['min_height'] = 300;
			$config['overwrite'] = true;
			$config['file_name'] = 'pacote_'.$this->input->post('id').'.png';
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload('file');
		} else {
			return true;
		}
	}

	/*Função na qual irá realizar a inclusão de
	* um novo pacote, validando os dados através
	* do 'form_validation' e preparando o envio
	* do pacote através da classe/biblioteca 'upload'.
	* Após verificar se o upload foi realizado com
	* sucesso é então feita a atribuição de permissões
	* ao arquivo do pacote por meio da função 'chmod'
	* e permitir o acesso das imagens para as views.
	*/
	public function inserir(){
		$this->texto_m->validacao();
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem[inserir]');

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('pacote/cadastrar');
			$this->load->view('template/footer');
		} else {
			# Conversão de datas
			$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));

			$this->pacote_m->setTitulo($this->input->post('titulo'));
			$this->pacote_m->setDataInclusao($data_inclusao);
			$this->pacote_m->setRegulamentos($this->input->post('regulamento0'));
			$caminho = 'pacote_'.($this->db->count_all('pousada_pacote') + 1).'.png';
			$this->pacote_m->setCaminho($caminho);
			$this->pacote_m->inserir();

			$this->log_m->setTabela('pousada_pacote');
			$this->log_m->setLinha($this->db->count_all('pousada_pacote') + 1);
			$this->log_m->setOperacao('i');
			$this->log_m->setDescricao(					'Titulo: '.
			$this->pacote_m->getTitulo()			 .'!break!Regulamentoss: '.
			$this->pacote_m->getRegulamentos() .'!break!Data de Inclusão: '.
			$this->pacote_m->getDataInclusao() .'!break!Id do item: '.
			$this->db->insert_id());
			$this->log_m->inserir();

			# Mensagem de sucesso e retorno a lista de pacotes.
			$this->session->set_userdata('status', 'SUCESSO');
			redirect('Pacote/Listar');
		}
	}

	/*Função na qual irá realizar o redirecionamento
	* para o pacote que possui o $id passado por parâmetro.
	*/
	public function editar($id){
		$this->pacote_m->editar($id);
		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('pacote/editar');
		$this->load->view('template/footer');
	}

	/*Função na qual irá atualizar as informações
	* sobre o pacote que são o Titulo e o status
	* de Ativo que é um trigger para exibição do
	* pacote no carrosel.
	*/
	public function atualizar(){
		$this->texto_m->validacao();
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem[atualizar]');

		if($this->form_validation->run() == FALSE) {
			$this->pacote_m->editar($this->input->post('id'));

			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('pacote/editar');
			$this->load->view('template/footer');
		} else {
			# Conversão de datas
			$data_alteracao = $this->texto_m->conversaoData($this->input->post('dataAlteracao'));

			# Atribuindo novos valores aos objetos de pacotes e midias
			$this->pacote_m->editar($this->input->post('id'));
			$this->pacote_m->setTitulo($this->input->post('titulo'));

			$this->pacote_m->setRegulamentos($this->texto_m->montarRegulamento());
			$this->pacote_m->setDataAlteracao($data_alteracao);
			$this->pacote_m->atualizar();

			$this->log_m->setTabela('pousada_pacote');
			$this->log_m->setLinha($this->input->post('id'));
			$this->log_m->setOperacao('u');
			$this->log_m->setDescricao(						'Titulo: '.
			$this->pacote_m->getTitulo()				 .'!break!Regulamentos: '.
			$this->pacote_m->getRegulamentos()	 .'!break!Data de Alteração: '.
			$this->pacote_m->getDataAlteracao()  .'!break!Id do item: '.
			$this->input->post('id'));
			$this->log_m->inserir();
			$this->session->set_userdata('status', 'SUCESSO');

			redirect('Pacote/Listar');
		}
	}

	/*Função na qual irá listar todos os pacotes
	* que estão no banco de dados através da função
	* 'todos' da classe 'pacote_m'.
	*/
	public function listar(){
		$result = $this->pacote_m->listar();
		$data['result'] = $result;

		$this->session->set_userdata('css_js', 'tabela');

		$this->load->view('template/header');
		$this->load->view('pacote/listar', $data);
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}
}
