<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->session->set_userdata('titulo_pagina', 'Login');
		$this->session->unset_userdata('css_js');
	}

	public function index(){
		redirect('Login/Entrar');
	}

	/*Função não utilizada
	*/
	public function listar(){
		//$this->acesso_m->permitir('ALL');
		$this->login_m->permitir('ALL');

		$result = $this->login_m->todos();
		$data['result'] = $result;

		$this->session->set_userdata('css_js', 'tabela');

		$this->load->view('template/header');
		$this->load->view('login/listar', $data);
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}

	/*Função na qual cadastra um novo usuário/colaborador
	* no sistema, utilizando uma estrutura 'if' para verificar
	* se já existe algum usuário/colaborador cadastrado no
	* banco de dados. Caso não esteja registrado, a função
	* redireciona para tela de cadastro.
	*/
	public function cadastrar($colaborador){
		$this->acesso_m->permitir('ALL');

		if($this->login_m->total_colaborador($colaborador)>0){
			redirect('Login/Editar/'.$colaborador);
		}

		$this->colaborador_m->listar_id_nome($colaborador);
		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('login/cadastrar');
		$this->load->view('template/footer');
	}

	/*Função na qual utiliza form_validation para averiguar
	* os dados de entrada. Após verificadas é feito o
	* redirecionamento para a lista de usuparios e adicionado
	* ao sistema.
	*/
	public function inserir(){
		$this->acesso_m->permitir('ALL');

		$this->texto_m->validacao();
		$this->form_validation->set_rules('colaborador', 'Colaborador', 'required|max_length[5]');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|max_length[30]|is_unique[usu_login.log_login]|addslashes|htmlspecialchars');
		$this->form_validation->set_rules('permissao', 'Permissão', 'trim|required|exact_length[3]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|matches[senha_n]|addslashes|htmlspecialchars|md5');
		$this->form_validation->set_rules('senha_n', 'Confirmar Senha', 'trim|required');
		$this->form_validation->set_rules('obs', 'Observação', 'trim');

		if($this->form_validation->run() == FALSE){
			if($this->login_m->total_colaborador($this->input->post('colaborador'))>0){
				redirect('Login/Editar/'.$this->input->post('colaborador'));
			}

			$this->colaborador_m->listar_id_nome($this->input->post('colaborador'));
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('login/cadastrar');
			$this->load->view('template/footer');
		}else{
			$this->login_m->setColaborador($this->input->post('colaborador'));
			$this->login_m->setLogin($this->input->post('login'));
			$this->login_m->setSenha($this->input->post('senha'));
			$this->login_m->setPermissao($this->input->post('permissao'));
			$this->login_m->setObs($this->input->post('obs'));
			$this->login_m->inserir();

			$this->session->set_userdata('status', 'SUCESSO');
			redirect('Login/Listar');
		}
	}

	/*Função na qual irá buscar as informações
	* do usuário/colaborador no banco de dados
	* através da classe colaborador_m com a função
	* 'editar', armazenando temporariamente todos
	* dados de usuário e assim atribuindo esses
	* dados a array $data.
	*/
	public function editar($id){
		$this->acesso_m->permitir('ALL');

		$this->login_m->editar($id);

		$this->colaborador_m->listar_id_nome($this->login_m->getColaborador());

		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('login/editar');
		$this->load->view('template/footer');
	}

	/*Função na qual irá atualizar as informações
	* de um usuário/colaborador existente. Utilizando
	* do 'form_validation' para averiguar os novos
	* dados que substituirão os atuais. Então o
	* usuário é redirecionado para lista de usuários
	* se estiverem validados.
	*/
	public function update(){
		$this->acesso_m->permitir('ALL');

		$this->texto_m->validacao();

		$this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|max_length[30]|htmlspecialchars');
		$this->form_validation->set_rules('permissao', 'Permissão', 'trim|required|exact_length[3]');
		$this->form_validation->set_rules('obs', 'Observação', 'trim');
		$this->form_validation->set_rules('ativo', 'Ativo', 'trim|required|in_list[s,n]');
		if($this->form_validation->run() == FALSE){
			$this->login_m->editar($this->input->post('id'));

			$this->colaborador_m->listar_id_nome($this->login_m->getColaborador());

			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('login/editar');
			$this->load->view('template/footer');
		}else{
			$this->login_m->editar($this->input->post('id'));
			$this->login_m->setLogin($this->input->post('login'));
			$this->login_m->setPermissao($this->input->post('permissao'));
			$this->login_m->setObs($this->input->post('obs'));
			$this->login_m->setAtivo($this->input->post('ativo'));
			$this->login_m->update();

			$this->session->set_userdata('status', 'SUCESSO');
			redirect('Login/Listar');
		}
	}

	/*Função não utilizada
	*/
	public function senha($id){
		$this->login_m->permitir();

		$this->usuario_m->editar($id);

		$this->colaborador_m->listar_id_nome($this->login_m->getColaborador());

		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('login/senha');
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}

	/*Função na qual realiza a atualização da senha
	* atual do usuário. Utilizando da form_validation
	* para verificar as senhas digitadas, após validação
	* é então atualizada a senha no banco de dados.
	*/
	public function senha_update(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|matches[senha_n]|htmlspecialchars|md5');
		$this->form_validation->set_rules('senha_n', 'Confirmar Senha', 'trim|required');

		$this->acesso_m->permitir_user($this->input->post('id'));

		if($this->form_validation->run() == FALSE){
			$this->login_m->editar($this->input->post('id'));

			$this->colaborador_m->listar_id_nome($this->login_m->getColaborador());

			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('login/senha');
			$this->load->view('template/footer');
		}else{
			$this->login_m->editar($this->input->post('id'));
			$this->login_m->setSenha($this->input->post('senha'));
			$this->login_m->update_senha();

			$this->session->set_userdata('status', 'SUCESSO');
			redirect('Login/Senha/'.$this->input->post('id'));
		}
	}

	/*Função na qual redireciona o usuário (não
	* autenticado) para tela de login.
	*/
	public function entrar(){
		$this->session->set_userdata('css_js', 'entrar');

		$this->load->view('template/header');
		$this->load->view('login/entrar');
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}

	public function validar(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('login', 'Login', 'trim|required|max_length[30]|addslashes|htmlspecialchars');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|addslashes|htmlspecialchars|md5');
		$this->form_validation->set_rules('lembrar', 'Lembre-me', 'trim|addslashes|htmlspecialchars');

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'entrar');

			$this->load->view('template/header');
			$this->load->view('login/entrar');
			$this->load->view('template/footer');
		}else{
			$login = $this->texto_m->sqlinjection($this->input->post('login'));
			$senha = $this->texto_m->sqlinjection($this->input->post('senha'));

			if($this->login_m->login_total($login)<1){
				$this->session->set_userdata('status', 'LOGIN_INVALIDO');
				$this->session->set_userdata('css_js', 'entrar');

				$this->load->view('template/header');
				$this->load->view('login/entrar');
				$this->load->view('template/footer');

				$this->acesso_m->setUsuario('');
				$this->acesso_m->setIp($this->texto_m->ip());
				$this->acesso_m->setAcesso(1);
				$this->acesso_m->inserir();

				$this->session->unset_userdata('status');
			} else if($this->login_m->login_total2($login, $senha)<1){
				$this->session->set_userdata('status', 'LOGIN_INVALIDO');
				$this->session->set_userdata('css_js', 'entrar');

				$this->load->view('template/header');
				$this->load->view('login/entrar');
				$this->load->view('template/footer');

				$this->acesso_m->setUsuario($this->login_m->login_id($login));
				$this->acesso_m->setIp($this->texto_m->ip());
				$this->acesso_m->setAcesso(2);
				$this->acesso_m->inserir();

				$this->session->unset_userdata('status');
			} else {
				$this->login_m->login($login, $senha);

				if($this->login_m->getAtivo()<>'s'){
					$this->acesso_m->setUsuario($this->login_m->getId());
					$this->acesso_m->setIp($this->texto_m->ip());
					$this->acesso_m->setAcesso(3);
					$this->acesso_m->inserir();

					$this->session->set_userdata('status', 'LOGIN_DESATIVADO');
					redirect('Login/Entrar');
				}

				if($this->ip_m->validar($this->texto_m->ip())<1){
					$this->acesso_m->setUsuario($this->login_m->getId());
					$this->acesso_m->setIp($this->texto_m->ip());
					$this->acesso_m->setAcesso(4);
					$this->acesso_m->inserir();

					$this->session->set_userdata('status', 'LOGIN_IP_INVALIDO');
					redirect('Login/Entrar');
				}

				$this->acesso_m->setUsuario($this->login_m->getId());
				$this->acesso_m->setIp($this->texto_m->ip());
				$this->acesso_m->setAcesso(5);
				$this->acesso_m->inserir();

				$sessao_user = array(
					'user_id'=>$this->login_m->getId(),
					'user_nome'=>$this->login_m->getNome(),
					'user_login'=>$this->login_m->getLogin(),
					'user_ip'=>$this->texto_m->ip(),
					'status'=>'LOGIN_SUCESSO'
				);
				$this->session->set_userdata($sessao_user);

				$this->online_m->apagar($this->login_m->getId());

				$this->online_m->setLogin($this->login_m->getId());
				$this->online_m->setIp($this->texto_m->ip());
				$this->online_m->setHost($this->texto_m->host());
				$this->online_m->setOs($this->texto_m->sistema_operacional());
				$this->online_m->setNavegador($this->texto_m->navegador());
				$this->online_m->inserir();

				if($this->input->post('lembrar')=='lembrar'){
					$cookie = array(
						'name'   => 'id',
						'value'  => $this->login_m->getId(),
						'expire' => '432000'
					);

					$this->input->set_cookie($cookie);

					$cookie = array(
						'name'   => 'login',
						'value'  => $this->login_m->getLogin(),
						'expire' => '432000'
					);

					$this->input->set_cookie($cookie);

					$cookie = array(
						'name'   => 'ip',
						'value'  => $this->texto_m->ip(),
						'expire' => '432000'
					);

					$this->input->set_cookie($cookie);
				}

				redirect();
			}
		}
	}

	public function sair(){
		$this->online_m->apagar($this->session->user_id);

		$this->acesso_m->setUsuario($this->session->user_id);
		$this->acesso_m->setIp($this->texto_m->ip());
		$this->acesso_m->setAcesso(7);
		$this->acesso_m->inserir();

		$sessao_user = array(
			'user_id',
			'user_nome',
			'user_login',
			'user_ip',
			'status'
		);
		$this->session->unset_userdata($sessao_user);
		$this->session->set_userdata('status', 'LOGIN_SAIR');

		delete_cookie('id');
		delete_cookie('login');
		delete_cookie('ip');
		redirect('Login/Entrar');
	}

	public function online(){
		$this->acesso_m->permitir('ALL');

		$result = $this->online_m->todos();
		$data['result'] = $result;

		$this->session->set_userdata('css_js', 'tabela');

		$this->load->view('template/header');
		$this->load->view('login/online', $data);
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}

	public function expulsar($login){
		$this->online_m->apagar($login);

		$sessao_user = array(
			'user_id',
			'user_nome',
			'user_login',
			'user_ativo',
			'user_ip',
			'status'
		);
		$this->session->unset_userdata($sessao_user);
		$this->session->set_userdata('status', 'LOGIN_EXPULSAR');

		delete_cookie('colaborador');
		delete_cookie('login');
		redirect('Login/Online');
	}

	public function off(){
		$sessao_user = array(
			'user_id',
			'user_nome',
			'user_login',
			'user_ativo',
			'user_ip',
			'status'
		);
		$this->session->unset_userdata($sessao_user);
		$this->session->set_userdata('status', 'LOGIN_OFF');

		delete_cookie('colaborador');
		delete_cookie('login');
		redirect();
	}
}
