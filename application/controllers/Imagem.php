<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Imagem extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->login_m->permitir();

		$this->session->set_userdata('titulo_pagina', 'Imagem');
		$this->session->unset_userdata('css_js');

		$this->load->model('imagem_m');
		$this->load->model('midia_m');
	}

	public function index() {
		redirect('Imagem/Listar');
	}

	/*Função na qual irá redirecionar para
	* a inclusão de um novo imagem.
	*/
	public function adicionar() {
		$this->session->set_userdata('css_js', 'formulario');
		$this->load->view('template/header');
		$this->load->view('imagem/cadastrar');
		$this->load->view('template/footer');
	}

	/*Função na qual realiza a validação das imagens de
	* apresentação , utilizando como callback do form_validation.
	*/
	public function validarImagem($img,$type){
		if ($type == 'inserir') {
			$config['upload_path']   = "assets/img/pousada_imagem";
			$config['allowed_types'] = 'jpg|png';
			$config['max_width'] = 2049; $config['max_height'] = 1556;
			$config['min_width'] = 300; $config['min_height'] = 300;
			$config['overwrite'] = true;
			$config['file_name'] = 'imagem_'.($this->db->count_all('pousada_imagem') + 1).'.jpg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload('file');
		} elseif($img) {
			$config['upload_path']   = "assets/img/pousada_imagem";
			$config['allowed_types'] = 'jpg|png';
			$config['max_width'] = 2049; $config['max_height'] = 1556;
			$config['min_width'] = 300; $config['min_height'] = 300;
			$config['overwrite'] = true;
			$config['file_name'] = 'imagem_'.$this->input->post('id').'.jpg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload('file');
		} else {
			return true;
		}
	}

	/*Função na qual irá realizar a inclusão de
	* um novo imagem, validando os dados através
	* do 'form_validation' e preparando o envio
	* do imagem através da classe/biblioteca 'upload'.
	* Após verificar se o upload foi realizado com
	* sucesso é então feita a atribuição de permissões
	* ao arquivo do imagem por meio da função 'chmod'
	* e permitir o acesso das imagens para as views.
	*/
	public function inserir() {
		$this->texto_m->validacao();
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem[inserir]');

		if($this->form_validation->run() == FALSE) {
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('imagem/cadastrar');
			$this->load->view('template/footer');
		} else {
			# Conversão de datas
			$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));

			$this->midia_m->setTitulo($this->input->post('titulo'));
			$this->midia_m->setDataInclusao($data_inclusao);
			$this->midia_m->setLocal($this->input->post('opcao'));
			$this->midia_m->setTipo('imagem');

			# $midiaID recebe o ID para ser utilizado na chave estrangeira da imagem
			$midiaID = $this->midia_m->inserir();
			$this->imagem_m->setDataInclusao($data_inclusao);
			$caminho = 'imagem_'.($this->db->count_all('pousada_imagem') + 1).'.jpg';
			$this->imagem_m->setCaminho($caminho);
			$imagemID = $this->imagem_m->inserir($midiaID);

			$this->log_m->setTabela('pousada_imagem');
			$this->log_m->setLinha($imagemID);
			$this->log_m->setOperacao('i');
			$this->log_m->setDescricao(						'Titulo: '.
			$this->midia_m->getTitulo()					.'!break!Link: '.
			$this->midia_m->getLink()  					.'!break!Data de Inclusão: '.
			$this->midia_m->getDataInclusao()   .'!break!Local: '.
			$this->midia_m->getLocal() 					.'!break!Id do item: '.
			$imagemID);
			$this->log_m->inserir();

			# Mensagem de sucesso e retorno a lista de imagens.
			$this->session->set_userdata('status', 'SUCESSO');
			redirect('Imagem/Listar');
		}
	}

	/*Função na qual irá realizar o redirecionamento
	* para o imagem que possui o $id passado por parâmetro.
	*/
	public function editar($id){
		$this->imagem_m->editar($id);
		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('imagem/editar');
		$this->load->view('template/footer');
	}

	/*Função na qual irá atualizar as informações
	* sobre o imagem que são o Titulo e o status
	* de Ativo que é um trigger para exibição do
	* imagem no carrosel.
	*/
	public function atualizar(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('ativo', 'Ativo', 'trim|required');
		$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem[atualizar]');

		if($this->form_validation->run() == FALSE){
			$this->imagem_m->editar($this->input->post('id'));

			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('imagem/editar');
			$this->load->view('template/footer');
		} else {
			# Conversão de datas
			$data_alteracao = $this->texto_m->conversaoData($this->input->post('dataAlteracao'));

			# Atribuindo novos valores aos objetos de imagens e midias
			$this->imagem_m->editar($this->input->post('id'));
			$this->imagem_m->setDataAlteracao($data_alteracao);
			$this->imagem_m->setAtivo($this->texto_m->ativo_codigo($this->input->post('ativo')));

			$this->midia_m->setTitulo($this->input->post('titulo'));
			$this->midia_m->setDataAlteracao($data_alteracao);
			$this->midia_m->setTipo('imagem');
			$this->midia_m->setLink($this->input->post('link'));
			$this->midia_m->setAtivo($this->texto_m->ativo_codigo($this->input->post('ativo')));

			$midiaID = $this->midia_m->getId();
			$this->midia_m->atualizar();
			$this->imagem_m->atualizar();

			$this->log_m->setTabela('pousada_imagem');
			$this->log_m->setLinha($this->input->post('id'));
			$this->log_m->setOperacao('u');
			$this->log_m->setDescricao(						'Titulo: '.
			$this->midia_m->getTitulo()					.'!break!Link: '.
			$this->midia_m->getLink()  					.'!break!Data de Alteração: '.
			$this->midia_m->getDataAlteracao()  .'!break!Local: '.
			$this->midia_m->getLocal() 					.'!break!Id do item: '.
			$this->input->post('id'));
			$this->log_m->inserir();
			$this->session->set_userdata('status', 'SUCESSO');

			redirect('Imagem/Listar');
		}
	}


	/*Função na qual irá listar todos os imagens
	* que estão no banco de dados através da função
	* 'todos' da classe 'imagem_m'.
	*/
	public function listar(){
		$result = $this->imagem_m->listar();
		$data['result'] = $result;

		$this->session->set_userdata('css_js', 'tabela');

		$this->load->view('template/header');
		$this->load->view('imagem/listar', $data);
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}
}
