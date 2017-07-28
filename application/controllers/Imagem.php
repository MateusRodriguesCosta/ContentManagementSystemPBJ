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
	public function validarImagem(){
		return $this->edicao_m->validarResolucao($this->input->post('user'));
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
		$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem');

		if($this->form_validation->run() == FALSE) {
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('imagem/cadastrar');
			$this->load->view('template/footer');
		} else {
			# Conversão de datas
			$data_inclusao = str_replace('/', '-', $this->input->post('dataInclusao'));
			$data_inclusao = date_create_from_format('d-m-Y', $data_inclusao);
			$data_inclusao = date('Y-m-d H:i:s', $data_inclusao->getTimestamp());

			$this->midia_m->setTitulo($this->input->post('titulo'));
			$this->midia_m->setDataInclusao($data_inclusao);
			$this->midia_m->setLocal($this->input->post('opcao'));
			$this->midia_m->setTipo('imagem');

			# $midiaID recebe o ID para ser utilizado na chave estrangeira da imagem
			$midiaID = $this->midia_m->inserir();
			$this->imagem_m->setDataInclusao($data_inclusao);

			# Usuário que está logado e realizando a operação de inclusão e retorno
			# da verificação de recorte da imagem.
			$user = $this->input->post('user');
			$verificacao = $this->input->post('verificacao');

			# Cria arquivo com as especificações da edição realizada
			# Arquivo é utilizado por temporario.php para criar arquivo de edição
			$arquivo = fopen("assets/tmp/edicao_".$user.".txt", "w")
				or die("Não foi possível abrir o arquivo!");
			fwrite($arquivo, $midiaID.",imagem,".$verificacao.",inserir");
			fclose($arquivo);

			$caminho = 'imagem_'.$midiaID.'.jpg';
			$this->imagem_m->setCaminho($caminho);

			# Inclusão da imagem, mensagem de sucesso e retorno a lista de imagens.
			$imagemID = $this->imagem_m->inserir($midiaID);

			$this->log_m->setTabela('pousada_imagem');
			$this->log_m->setLinha($imagemID);
			$this->log_m->setOperacao('i');
			$this->log_m->setDescricao(						'Titulo: '.
				$this->midia_m->getTitulo()					.'!break!Link: '.
				$this->midia_m->getLink()  					.'!break!Data de Inclusão: '.
				$this->midia_m->getDataInclusao()   .'!break!Local: '.
				$this->midia_m->getLocal() 					.'!break!Id do item: '.
				$imagemID               						.'!break!!break!'.
				$verificacao
			);
			$this->log_m->inserir();

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
		$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem');

		if($this->form_validation->run() == FALSE){
			$this->imagem_m->editar($this->input->post('id'));

			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('imagem/editar');
			$this->load->view('template/footer');
		}else{
			# Conversão de datas
			$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));
			$data_alteracao = $this->texto_m->conversaoData($this->input->post('dataAlteracao'));

			# Atribuindo novos valores aos objetos de imagens e midias
			$this->imagem_m->editar($this->input->post('id'));
			$this->imagem_m->setDataInclusao($data_inclusao);
			$this->imagem_m->setDataAlteracao($data_alteracao);
			$this->imagem_m->setAtivo($this->texto_m->ativo_codigo($this->input->post('ativo')));

			$this->midia_m->setTitulo($this->input->post('titulo'));
			$this->midia_m->setDataInclusao($data_inclusao);
			$this->midia_m->setDataAlteracao($data_alteracao);
			$this->midia_m->setTipo('imagem');
			$this->midia_m->setLink($this->input->post('link'));
			$this->midia_m->setAtivo($this->texto_m->ativo_codigo($this->input->post('ativo')));

			# Usuário que está logado e realizando a operação de edição e retorno
			# da verificação de recorte da imagem.
			$user = $this->input->post('user');
			$verificacao = $this->input->post('verificacao');
			$midiaID = $this->midia_m->getId();

			# Cria arquivo com as especificações da edição realizada
			# Arquivo é utilizado por temporario.php para criar arquivo de edição
			$arquivo = fopen("assets/tmp/edicao_".$user.".txt", "w")
				or die("Não foi possível abrir o arquivo!");
			fwrite($arquivo, $midiaID.",imagem,".$verificacao.",atualizar");
			fclose($arquivo);

			$caminho = 'imagem_'.$midiaID.'.jpg';
			$this->imagem_m->setCaminho($caminho);

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
				$this->input->post('id') 						.'!break!!break!'.
				$verificacao
			);
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
