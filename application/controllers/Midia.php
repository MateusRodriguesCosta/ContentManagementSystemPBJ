<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Midia extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->login_m->permitir();

		$this->session->set_userdata('titulo_pagina', 'Midia');
		$this->session->unset_userdata('css_js');

		$this->load->model('midia_m');
		$this->load->model('banner_m');
	}

	public function index(){
		redirect('Midia/Listar');
	}

	/*Função na qual irá redirecionar para
	* a inclusão de um novo banner.
	*/
	public function adicionar(){
		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('midia/cadastrar');
		$this->load->view('template/footer');
		$arquivotemporario = 'assets/tmp/validacao_'.$this->session->user_nome.'.txt';
		if(file_exists($arquivotemporario)): unlink($arquivotemporario); endif;
	}

	/*Função na qual realiza a validação das imagens de
	* apresentação , utilizando como callback do form_validation.
	*/
	public function validarImagem($imagem, $tipo){
		$usuario = $this->input->post('user');
		$caminhoTemporarioOriginal = 'assets/tmp/edicao_tmp_'.$usuario.'.jpg';
		$validacao = 'assets/tmp/validacao_'.$usuario.'.txt';
		$verificacao = $this->input->post('verificacao');
		if (file_exists($caminhoTemporarioOriginal)) {
			$resolucao = getimagesize($caminhoTemporarioOriginal);
			$tamanho   = filesize($caminhoTemporarioOriginal);
			return ($resolucao[0]<=2000 && $resolucao[1]<=1200) ? (($tamanho < 1048576) ? true : false ): false;
		} elseif($verificacao == 'true' || (!file_exists($validacao) && $tipo == 'atualizar')) {
			return true;
		} else {
			unlink($validacao);
			return false;
		}
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
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
		//$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem[inserir]');

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('midia/cadastrar');
			$this->load->view('template/footer');
		}else{

			$this->midia_m->setTitulo($this->input->post('titulo'));
			$this->midia_m->setTipo('midia');
			$this->midia_m->setLocal($this->input->post('opcao'));
			switch ($this->input->post('opcao')) {
				case 'Página Principal':
				$this->midia_m->setLink($this->input->post('link'));
				$this->midia_m->setDescricao($this->input->post('texto'));
				break;
				case 'A Pousada - Visitas Ilustres':
				$this->midia_m->setDescricao($this->input->post('texto'));
				$this->midia_m->setPeriodo($this->input->post('periodo'));
				break;
				case 'Fé e Lazer - Pousada':
				$this->midia_m->setDescricao($this->input->post('texto'));
				break;
				case 'Eventos - Ambientes':
				$this->midia_m->setCapacidade($this->input->post('capacidade'));
				$this->midia_m->setEquipamentos($this->input->post('equipamentos'));
				break;
				case 'Restaurante':
				$this->midia_m->setDescricao($this->input->post('texto'));
				break;
			}
			# Conversão de datas
			$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));
			$this->midia_m->setDataInclusao($data_inclusao);

			$ID = '1';
			# Verifica o ID da nova midia que será inserida.
			foreach($this->midia_m->retornarId() as $row){
				if ($row->mid_id!='' && $row->mid_id!=null && $row->mid_id!=0) {
					$ID = $row->mid_id + 1;
				}
			}
			$caminho = 'midia_'.$ID.'.jpg';

			$config['upload_path']   = './assets/img/pousada_midia/';
			$config['allowed_types'] = 'gif|jpg|png';
			//$config['max_width'] = 650; $config['max_height'] = 420;
			//$config['min_width'] = 610; $config['min_height'] = 390;
			$config['overwrite'] = true;
			$config['file_name'] = $caminho;
			$this->load->library('upload', $config);
			($this->upload->do_upload('file'))? true : false;

			$this->midia_m->setCaminho($caminho);

			# Inclusão da midia.
			$midiaID = $this->midia_m->inserir();

			$this->log_m->setTabela('pousada_midia');
			$this->log_m->setLinha($midiaID);
			$this->log_m->setOperacao('i');
			$this->log_m->setDescricao(																								'Titulo: '.
			$this->midia_m->getTitulo()																							.'!break!Link: '.
			$this->texto_m->verificarConteudo($this->midia_m->getLink())  					.'!break!Local: '.
			$this->midia_m->getLocal()																							.'!break!Data de Inclusão: '.
			$this->midia_m->getDataInclusao()   																		.'!break!Id do item: '.
			$midiaID               						  																		.'!break!Equipamentos: '.
			$this->texto_m->verificarConteudo($this->midia_m->getEquipamentos())  	.'!break!Capacidade: '.
			$this->texto_m->verificarConteudo($this->midia_m->getCapacidade())			.'!break!Período: '.
			$this->texto_m->verificarConteudo($this->midia_m->getPeriodo())					.'!break!Descrição: '.
			$this->texto_m->verificarConteudo($this->midia_m->getDescricao())
		);
		$this->log_m->inserir();
		$this->session->set_userdata('status', 'SUCESSO');
		redirect('Midia/Listar');
	}
}

/*Função na qual irá realizar o redirecionamento
* para o banner que possui o $id passado por parâmetro.
*/
public function editar($id){
	$this->midia_m->editar($id);
	$this->session->set_userdata('css_js', 'formulario');

	$this->load->view('template/header');
	$this->load->view('midia/editar');
	$this->load->view('template/footer');
	$arquivotemporario = 'assets/tmp/validacao_'.$this->session->user_nome.'.txt';
	if(file_exists($arquivotemporario)): unlink($arquivotemporario); endif;
}

/*Função na qual irá atualizar as informações
* sobre o banner que são o Titulo e o status
* de Ativo que é um trigger para exibição do
* banner no carrosel.
*/
public function atualizar(){
	$this->texto_m->validacao();

	$this->form_validation->set_rules('id', 'ID', 'trim|required');
	$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[65]');
	$this->form_validation->set_rules('ativo', 'Ativo', 'trim|required');
	//$this->form_validation->set_rules('file', 'Arquivo', 'callback_validarImagem[atualizar]');

	if($this->form_validation->run() == FALSE){
		$this->midia_m->editar($this->input->post('id'));
		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('midia/editar');
		$this->load->view('template/footer');
	}else{
		# Conversão de datas
		$data_alteracao = $this->texto_m->conversaoData($this->input->post('dataAlteracao'));

		$this->midia_m->editar($this->input->post('id'));
		$this->midia_m->setTitulo($this->input->post('titulo'));
		$this->midia_m->setDescricao($this->input->post('texto'));
		$this->midia_m->setDataAlteracao($data_alteracao);
		$this->midia_m->setTipo('midia');
		$this->midia_m->setLink($this->input->post('link'));
		$this->midia_m->setLocal($this->input->post('opcaoEditar'));
		$this->midia_m->setPeriodo($this->input->post('periodo'));
		$this->midia_m->setCapacidade($this->input->post('capacidade'));
		$this->midia_m->setEquipamentos($this->input->post('equipamentos'));
		$this->midia_m->setAtivo($this->texto_m->ativo_codigo($this->input->post('ativo')));

		# Usuário que está logado e realizando a operação de edição e retorno
		# da verificação de recorte.
		$midiaID = $this->midia_m->getId();
		$caminho = 'midia_'.$midiaID.'.jpg';

		$config['upload_path']   = './assets/img/pousada_midia/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_width'] = 650; $config['max_height'] = 420;
		//$config['min_width'] = 610; $config['min_height'] = 390;
		$config['overwrite'] = true;
		$config['file_name'] = $caminho;
		$this->load->library('upload', $config);
		($this->upload->do_upload('file'))? true : false;

		$this->midia_m->setCaminho($caminho);
		$this->midia_m->atualizar();

		$this->log_m->setTabela('pousada_midia');
		$this->log_m->setLinha($this->input->post('id'));
		$this->log_m->setOperacao('u');
		$this->log_m->setDescricao(																								'Titulo: '.
		$this->midia_m->getTitulo()																							.'!break!Link: '.
		$this->texto_m->verificarConteudo($this->midia_m->getLink())  					.'!break!Local: '.
		$this->midia_m->getLocal()																							.'!break!Data de Alteração: '.
		$this->midia_m->getDataAlteracao()																			.'!break!Id do item: '.
		$this->input->post('id')               						  										.'!break!Equipamentos: '.
		$this->texto_m->verificarConteudo($this->midia_m->getEquipamentos())  	.'!break!Capacidade: '.
		$this->texto_m->verificarConteudo($this->midia_m->getCapacidade())			.'!break!Período: '.
		$this->texto_m->verificarConteudo($this->midia_m->getPeriodo())					.'!break!Descrição: '.
		$this->texto_m->verificarConteudo($this->midia_m->getDescricao())				.'!break!!break!'.
		$verificacao
	);
	$this->log_m->inserir();

	$this->session->set_userdata('status', 'SUCESSO');
	redirect('Midia/Listar');
}
}

/*Função na qual irá listar todos as midias
* que estão no banco de dados através da função
* 'todos' da classe 'midia_m'.
*/
public function listar(){
	$result = $this->midia_m->listar();
	$data['result'] = $result;

	$this->session->set_userdata('css_js', 'tabela');

	$this->load->view('template/header');
	$this->load->view('midia/listar', $data);
	$this->load->view('template/footer');

	$this->session->unset_userdata('status');
}
}
