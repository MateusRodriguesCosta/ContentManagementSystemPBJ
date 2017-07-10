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
	public function validacaoAlcance($data) {
		$data = explode('/',$data);
		if(checkdate($data[1], $data[0], $data[2])) {
			return true;
		} else {
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

		$this->form_validation->set_rules('dataExpiracao', 'Data de Expiração', 'trim|required');
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[42]');
		$this->form_validation->set_rules('dataExpiracao', 'Expiracao', 'trim|required|regex_match[#^[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}$#]|callback_validacaoAlcance');

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

			# Caminho até os arquivos temporários dos banners.
			$temporarioOriginal = 'assets/tmp/edicao_tmp_'.$user.'.jpg';
			$temporarioRecorte = 'assets/tmp/edicao_tmp_recorte_'.$user.'.jpg';

			# Caminho que será utilizado para upload dos banners.
			$moverRecorte = 'assets/img/pousada_banner/banner_'.$midiaID.'.jpg';
			$moverOriginal = 'assets/img/pousada_originais/banner_'.$midiaID.'.jpg';

			# Sleep utilizado para espera das transferências assíncronas
			# pelo XMLHttpRequest. Sem o sleep podem ocorrer falhas entre
			# os arquivos de edição e a solicitação dos mesmos para copy().
			sleep(1.4);

			# Verifica se o arquivo de imagem foi enviado através do ajax
			# e se foi realizado algum recorte no banner.
			# Caminho Default em caso de não ocorrerem recortes.
			$this->banner_m->setCaminho(explode('/',$moverRecorte)[3]);
			if (file_exists($temporarioRecorte) && $verificacao == 'true') {
				copy($temporarioRecorte,$moverRecorte);
				$this->banner_m->setCaminho(explode('/',$moverRecorte)[3]);
				chmod($moverRecorte, 0777);
			} else if (file_exists($temporarioRecorte) && $verificacao == 'false') {
				copy($temporarioOriginal,$moverRecorte);
				$this->banner_m->setCaminho(explode('/',$moverRecorte)[3]);
				chmod($moverRecorte, 0777);
			}

			# Envia arquivo original de qualquer forma para resguardar o sistema
			# de possíveis falhas.
			if (file_exists($temporarioOriginal)) {
				copy($temporarioOriginal,$moverOriginal);
				chmod($moverOriginal, 0777);
			}

			# Inclusão do banner, mensagem de sucesso e retorno a lista de banners.
			$this->banner_m->inserir($midiaID);
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
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[42]');
		$this->form_validation->set_rules('dataExpiracao', 'Expiracao', 'trim|required|regex_match[#^[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}$#]|callback_validacaoAlcance');

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

			# Caminho até os arquivos temporários dos banners.
			$temporarioOriginal = 'assets/tmp/edicao_tmp_'.$user.'.jpg';
			$temporarioRecorte = 'assets/tmp/edicao_tmp_recorte_'.$user.'.jpg';

			# Caminho que será utilizado para upload dos banners.
			$moverRecorte = 'assets/img/pousada_banner/banner_'.$this->midia_m->getId().'.jpg';
			$moverOriginal = 'assets/img/pousada_originais/banner_'.$this->midia_m->getId().'.jpg';

			# Sleep utilizado para espera das transferências assíncronas
			# pelo XMLHttpRequest. Sem o sleep podem ocorrer falhas entre
			# os arquivos de edição e a solicitação dos mesmos para copy().
			sleep(1.2);

			# Verifica se o arquivo de imagem foi enviado através do ajax
			# e se foi realizado algum recorte no banner.
			if ($verificacao == 'false'){
				# # mover original para pousada_banner e para pousada_originais
				copy($temporarioOriginal,$moverOriginal);
				copy($temporarioOriginal,$moverRecorte);
				chmod($moverOriginal, 0777);
				chmod($moverRecorte, 0777);

				unlink($temporarioOriginal);
			}else if (!file_exists($temporarioOriginal) && $verificacao == 'true') {
				# # mover novo recorte em temporário para pousada_banner, apenas.
				copy($temporarioRecorte,$moverRecorte);
				chmod($moverRecorte, 0777);

			}else if (file_exists($temporarioOriginal) && $verificacao == 'true') {
				# # mover original para pousada_originais e recorte para pousada_banner.
				copy($temporarioOriginal,$moverOriginal);
				copy($temporarioRecorte,$moverRecorte);
				chmod($moverOriginal, 0777);
				chmod($moverRecorte, 0777);

				unlink($temporarioOriginal);
			}

			$this->midia_m->atualizar();
			$this->banner_m->atualizar();

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
