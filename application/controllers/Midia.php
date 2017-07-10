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

		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[42]');

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('midia/cadastrar');
			$this->load->view('template/footer');
		}else{
			# Sleep utilizado para espera das transferências assíncronas
			# pelo XMLHttpRequest. Sem o sleep podem ocorrer falhas entre
			# os arquivos de edição e a solicitação dos mesmos para copy().
			sleep(1.2);

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
				default:
				# codar...
				break;
			}
			# Conversão de datas
			$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));
			$this->midia_m->setDataInclusao($data_inclusao);

			# Usuário que está logado e realizando a operação de inclusão e retorno
			# da verificação de recorte do banner.
			$user = $this->input->post('user');
			$verificacao = $this->input->post('verificacao');

			# Caminho até os arquivos temporários das edições.
			$temporarioOriginal = 'assets/tmp/edicao_tmp_'.$user.'.jpg';
			$temporarioRecorte = 'assets/tmp/edicao_tmp_recorte_'.$user.'.jpg';

			# Caminho que será utilizado para upload dos banners.
			foreach($this->midia_m->retornarId() as $row){
				$ID = $row->mid_id + 1;
			}

			# Caminho que será utilizado para upload das midias.
			$moverRecorte = 'assets/img/pousada_midia/midia_'.$ID.'.jpg';
			$moverOriginal = 'assets/img/pousada_originais/midia_'.$ID.'.jpg';

			# Sleep utilizado para espera das transferências assíncronas
			# pelo XMLHttpRequest. Sem o sleep podem ocorrer falhas entre
			# os arquivos de edição e a solicitação dos mesmos para copy().
			sleep(1.4);

			# Verifica se o arquivo de imagem foi enviado através do ajax
			# e se foi realizado algum recorte na imagem da midia.
			# Caminho Default em caso de não ocorrerem recortes.
			$this->midia_m->setCaminho(explode('/',$moverRecorte)[3]);
			if ($verificacao == 'true') {
				copy($temporarioRecorte,$moverRecorte);
				$this->midia_m->setCaminho(explode('/',$moverRecorte)[3]);
				chmod($moverRecorte, 0777);
			} else if ($verificacao == 'false') {
				copy($temporarioOriginal,$moverRecorte);
				$this->midia_m->setCaminho(explode('/',$moverRecorte)[3]);
				chmod($moverRecorte, 0777);
			}

			# Envia arquivo original de qualquer forma para resguardar o sistema
			# de possíveis falhas.
			if (file_exists($temporarioOriginal)) {
				copy($temporarioOriginal,$moverOriginal);
				chmod($moverRecorte, 0777);
			}
			# Inclusão da midia.
			$midiaID = $this->midia_m->inserir();
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
	}

	/*Função na qual irá atualizar as informações
	* sobre o banner que são o Titulo e o status
	* de Ativo que é um trigger para exibição do
	* banner no carrosel.
	*/
	public function atualizar(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('titulo', 'Título', 'trim|required|max_length[42]');
		$this->form_validation->set_rules('ativo', 'Ativo', 'trim|required');

		if($this->form_validation->run() == FALSE){
			$this->midia_m->editar($this->input->post('id'));

			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('midia/editar');
			$this->load->view('template/footer');
		}else{
			# Conversão de datas
			$data_inclusao = $this->texto_m->conversaoData($this->input->post('dataInclusao'));
			$data_alteracao = $this->texto_m->conversaoData($this->input->post('dataAlteracao'));

			$this->midia_m->editar($this->input->post('id'));
			$this->midia_m->setTitulo($this->input->post('titulo'));
			$this->midia_m->setDescricao($this->input->post('texto'));
			$this->midia_m->setDataInclusao($data_inclusao);
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
			$user = $this->input->post('user');
			$verificacao = $this->input->post('verificacao');

			# Caminho até os arquivos temporários das edições.
			$temporarioOriginal = 'assets/tmp/edicao_tmp_'.$user.'.jpg';
			$temporarioRecorte = 'assets/tmp/edicao_tmp_recorte_'.$user.'.jpg';

			# Caminho que será utilizado para upload das edições.
			$moverRecorte = 'assets/img/pousada_midia/midia_'.$this->midia_m->getId().'.jpg';
			$moverOriginal = 'assets/img/pousada_originais/midia_'.$this->midia_m->getId().'.jpg';

			# Sleep utilizado para espera das transferências assíncronas
			# pelo XMLHttpRequest. Sem o sleep podem ocorrer falhas entre
			# os arquivos de edição e a solicitação dos mesmos para copy().
			sleep(1.2);

			# Verifica se o arquivo de imagem foi enviado através do ajax
			# e se foi realizado algum recorte.
			if ($verificacao == 'false'){
				# # mover original para pousada_midia e para pousada_originais
				copy($temporarioOriginal,$moverOriginal);
				copy($temporarioOriginal,$moverRecorte);
				chmod($moverOriginal, 0777);
				chmod($moverRecorte, 0777);

				unlink($temporarioOriginal);
			}else if (!file_exists($temporarioOriginal) && $verificacao == 'true') {
				# # mover novo recorte em temporário para pousada_midia, apenas.
				copy($temporarioRecorte,$moverRecorte);
				chmod($moverRecorte, 0777);

			}else if (file_exists($temporarioOriginal) && $verificacao == 'true') {
				# # mover original para pousada_originais e recorte para pousada_midia.
				copy($temporarioOriginal,$moverOriginal);
				copy($temporarioRecorte,$moverRecorte);
				chmod($moverOriginal, 0777);
				chmod($moverRecorte, 0777);

				unlink($temporarioOriginal);
			}

			$this->midia_m->atualizar();

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
