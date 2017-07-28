<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Banner extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->session->set_userdata('titulo_pagina', 'Banner');
		$this->session->unset_userdata('css_js');

		$this->load->model('banner_m');
		$this->load->model('midia_m');
	}

	public function index(){
		redirect('Banner/Listar');
	}

	/*Função na qual irá redirecionar para
	* a inclusão de um novo banner.
	*/
	public function adicionar(){
		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('banner/cadastrar');
		$this->load->view('template/footer');
	}

	/*Função na qual realiza a validação das datas de
	* expiracao dos banners, utilizando como callback
	* do form_validation.
	*/
	public function validarAlcance($data) {
		$data = explode('/',$data);
		if (isset($data[1]) && isset($data[0]) && isset($data[2])) {
			if(checkdate($data[1], $data[0], $data[2])) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/*Função na qual realiza a validação das imagens de
	* apresentação , utilizando como callback do form_validation.
	*/
	public function validarImagem(){
		return $this->edicao_m->validarResolucao($this->input->post('user'));
	}

	/*Função na qual irá realizar a inclusão de
	* um novo banner, validando os dados através
	* do 'form_validation' e preparando o envio
	* do banner através da classe/biblioteca 'upload'.
	* Após verificar se o upload foi realizado com
	* sucesso é então feita a atribuição de permissões
	* ao arquivo do banner por meio da função 'chmod'
	* e permitir o acesso das imagens para as views.
	*/
	public function inserir(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('dataExpiracao', 'Data de Expiração', 'trim|required');
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
		$this->form_validation->set_rules('dataExpiracao', 'Expiracao', 'trim|required|regex_match[#^[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}$#]|callback_validarAlcance');
		$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem');

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('banner/cadastrar');
			$this->load->view('template/footer');
		}else{
			# Conversão de datas
			$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));
			$data_expiracao = $this->texto_m->conversaoData($this->input->post('dataExpiracao'));

			$this->midia_m->setTitulo($this->input->post('titulo'));
			$this->midia_m->setDataInclusao($data_inclusao);
			$this->midia_m->setLocal('Página Principal');
			$this->midia_m->setTipo('banner');
			$this->midia_m->setLink($this->input->post('link'));

			# Inclusão da imagem, mensagem de sucesso e retorno a lista de imagens.
			$midiaID = $this->midia_m->inserir();
			$this->banner_m->setDataInclusao($data_inclusao);
			$this->banner_m->setDataExpiracao($data_expiracao);

			# Usuário que está logado e realizando a operação de inclusão e retorno
			# da verificação de recorte do banner.
			$user = $this->input->post('user');
			$verificacao = $this->input->post('verificacao');

			# Cria arquivo com as especificações da edição realizada
			# Arquivo é utilizado por temporario.php para criar arquivo de edição
			$arquivo = fopen("assets/tmp/edicao_".$user.".txt", "w")
				or die("Não foi possível abrir o arquivo!");
			fwrite($arquivo, $midiaID.",banner,".$verificacao.",inserir");
			fclose($arquivo);

			$caminho = 'banner_'.$midiaID.'.jpg';
			$this->banner_m->setCaminho($caminho);

			# Inclusão do banner, mensagem de sucesso e retorno a lista de banners.
			$bannerID = $this->banner_m->inserir($midiaID);

			$this->log_m->setTabela('pousada_banner');
			$this->log_m->setLinha($bannerID);
			$this->log_m->setOperacao('i');
			$this->log_m->setDescricao(						'Titulo: '.
			$this->midia_m->getTitulo()					.'!break!Link: '.
			$this->midia_m->getLink()  					.'!break!Data de Inclusão: '.
			$this->midia_m->getDataInclusao()   .'!break!Data de Expiração: '.
			$this->banner_m->getDataExpiracao() .'!break!Id do item: '.
			$bannerID               						.'!break!!break!'.
			$verificacao
		);
		$this->log_m->inserir();

		$this->session->set_userdata('status', 'SUCESSO');
		redirect('Banner/Listar');
	}
}

/*Função na qual irá realizar o redirecionamento
* para o banner que possui o $id passado por parâmetro.
*/
public function editar($id){
	$this->banner_m->editar($id);
	$this->session->set_userdata('css_js', 'formulario');

	$this->load->view('template/header');
	$this->load->view('banner/editar');
	$this->load->view('template/footer');
}

/*Função na qual irá atualizar as informações
* sobre o banner que são o Titulo e o status
* de Ativo que é um trigger para exibição do
* banner no carrosel.
*/
public function atualizar(){
	$this->texto_m->validacao();

	$this->form_validation->set_rules('dataExpiracao', 'Data de Expiração', 'trim|required');
	$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
	$this->form_validation->set_rules('dataExpiracao', 'Expiracao', 'trim|required|regex_match[#^[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}$#]|callback_validarAlcance');
	$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem');

	if($this->form_validation->run() == FALSE){
		$this->banner_m->editar($this->input->post('id'));

		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('banner/editar');
		$this->load->view('template/footer');
	}else{
		# Conversão de datas
		$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));
		$data_alteracao = $this->texto_m->conversaoData($this->input->post('dataAlteracao'));
		$data_expiracao = $this->texto_m->conversaoData($this->input->post('dataExpiracao'));

		# Atribuindo novos valores aos objetos de banners e midias
		$this->banner_m->editar($this->input->post('id'));
		$this->banner_m->setDataInclusao($data_inclusao);
		$this->banner_m->setDataAlteracao($data_alteracao);
		$this->banner_m->setDataExpiracao($data_expiracao);
		$this->banner_m->setAtivo($this->texto_m->ativo_codigo($this->input->post('ativo')));

		$this->midia_m->setTitulo($this->input->post('titulo'));
		$this->midia_m->setDataInclusao($data_inclusao);
		$this->midia_m->setDataAlteracao($data_alteracao);
		$this->midia_m->setLocal('Página Principal');
		$this->midia_m->setTipo('banner');
		$this->midia_m->setLink($this->input->post('link'));
		$this->midia_m->setAtivo($this->texto_m->ativo_codigo($this->input->post('ativo')));

		# Usuário que está logado e realizando a operação de edição e retorno
		# da verificação de recorte do banner.
		$user = $this->input->post('user');
		$verificacao = $this->input->post('verificacao');
		$midiaID = $this->midia_m->getId();

		# Cria arquivo com as especificações da edição realizada
		# Arquivo é utilizado por temporario.php para criar arquivo de edição
		$arquivo = fopen("assets/tmp/edicao_".$user.".txt", "w")
			or die("Não foi possível abrir o arquivo!");
		fwrite($arquivo, $midiaID.",banner,".$verificacao.",atualizar");
		fclose($arquivo);

		$caminho = 'banner_'.$midiaID.'.jpg';
		$this->banner_m->setCaminho($caminho);

		$this->midia_m->atualizar();
		$this->banner_m->atualizar();

		$this->log_m->setTabela('pousada_banner');
		$this->log_m->setLinha($this->input->post('id'));
		$this->log_m->setOperacao('u');
		$this->log_m->setDescricao(						'Titulo: '.
		$this->midia_m->getTitulo()					.'!break!Link: '.
		$this->midia_m->getLink()  					.'!break!Data de Alteração: '.
		$this->midia_m->getDataAlteracao()  .'!break!Data de Expiração: '.
		$this->banner_m->getDataExpiracao() .'!break!Id do item: '.
		$this->input->post('id')						.'!break!!break!'.
		$verificacao
	);
	$this->log_m->inserir();

	$this->session->set_userdata('status', 'SUCESSO');

	redirect('Banner/Listar');
}
}

/*Função na qual irá listar todos os banners
* que estão no banco de dados através da função
* 'todos' da classe 'banner_m'.
*/
public function listar(){
	$result = $this->banner_m->listar();
	$data['result'] = $result;

	$this->session->set_userdata('css_js', 'tabela');

	$this->load->view('template/header');
	$this->load->view('banner/listar', $data);
	$this->load->view('template/footer');

	$this->session->unset_userdata('status');
}
}
