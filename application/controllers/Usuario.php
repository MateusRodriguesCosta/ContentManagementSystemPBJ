<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller {

	public function __construct(){
        parent::__construct();

				$this->login_m->permitir();

				$this->session->set_userdata('titulo_pagina', 'Usuário');
        $this->session->unset_userdata('css_js');

        $this->load->model('usuario_m');
    }

	public function index(){
		redirect('Usuario/Listar');
	}

	/*Função na qual irá redirecionar para a inclusão
	* de um novo usuário.
	*/
	public function adicionar(){
		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('usuario/cadastrar');
		$this->load->view('template/footer');
	}

	/*Função na qual irá realizar a inclusão de
	* um novo usuário, validando os dados através
	* do 'form_validation'. Então atribui-se ao
	* novo usuário (usuario_m) seu Nome, Email,
	* Login e Senha.
	*/
	public function inserir(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|addslashes|htmlspecialchars|md5');
		$this->form_validation->set_rules('senha_n', 'Confirmar Senha', 'trim|required|addslashes|htmlspecialchars|md5|matches[senha]');

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('usuario/cadastrar');
			$this->load->view('template/footer');
		}else{
			//echo $this->input->post('nome').'<br>';
			$this->usuario_m->setNome($this->input->post('nome'));
			//echo $this->input->post('email').'<br>';
			$this->usuario_m->setEmail($this->input->post('email'));
			//echo $this->input->post('login').'<br>';
			$this->usuario_m->setLogin($this->input->post('login'));
			//echo $this->input->post('senha').'<br>';
			$this->usuario_m->setSenha($this->input->post('senha'));
			$this->usuario_m->inserir();

			$this->session->set_userdata('status', 'SUCESSO');

			redirect('Usuario/Listar');
		}
	}

	/*Função na qual irá buscar as informações
	* do usuário no banco de dados através da
	* classe usuário_m com a função 'editar',
	* armazenando temporariamente todos dados
	* de conta e atribuindo esses dados a array
	* $data.
	*/
	public function editar($id){
		$this->usuario_m->editar($id);

		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('usuario/editar');
		$this->load->view('template/footer');
	}

	/*Função na qual irá atualizar as informações
	* de um usuário existente no site. Utilizando
	* do 'form_validation' para averiguar os novos
	* dados que substituirão os atuais. Então o
	* usuário é redirecionado para lista de usuários
	* se estiverem validados.
	*/
	public function update(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|max_length[150]');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('ativo', 'Ativo', 'trim|required|in_list[s,n,1,0]');

		$this->usuario_m->editar($this->input->post('id'));

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('usuario/editar');
			$this->load->view('template/footer');
		}else{
			//echo $this->input->post('nome').'<br>';
			$this->usuario_m->setNome($this->input->post('nome'));
			//echo $this->input->post('email').'<br>';
			$this->usuario_m->setEmail($this->input->post('email'));
			//echo $this->input->post('login').'<br>';
			$this->usuario_m->setLogin($this->input->post('login'));
			//echo $this->input->post('ativo').'<br>';
			$this->usuario_m->setAtivo($this->input->post('ativo'));
			$this->usuario_m->update();

			$this->session->set_userdata('status', 'SUCESSO');

			redirect('Usuario/Listar');
		}
	}

	/*Função na qual irá redirecionar para definição
	* de senha do usuário que possui o $id passado
	* por parâmetro.
	*/
	public function senha($id){
		$this->usuario_m->editar($id);

		$this->session->set_userdata('css_js', 'formulario');

		$this->load->view('template/header');
		$this->load->view('usuario/editar_senha');
		$this->load->view('template/footer');
	}

	/*Função na qual irá realizar a atualização
	* da senha atual do usuário, validando as
	* informações através do form_validation e
	* da função 'update_senha' do 'usuario_m'.
	*/
	public function update_senha(){
		$this->texto_m->validacao();

		$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|addslashes|htmlspecialchars|md5');
		$this->form_validation->set_rules('senha_n', 'Confirmar Senha', 'trim|required|addslashes|htmlspecialchars|md5|matches[senha]');

		$this->usuario_m->editar($this->input->post('id'));

		if($this->form_validation->run() == FALSE){
			$this->session->set_userdata('css_js', 'formulario');

			$this->load->view('template/header');
			$this->load->view('usuario/editar_senha');
			$this->load->view('template/footer');
		}else{
			//echo $this->input->post('senha').'<br>';
			$this->usuario_m->setSenha($this->input->post('senha'));
			$this->usuario_m->update_senha();

			$this->session->set_userdata('status', 'SUCESSO');

			redirect('Usuario/Listar');
		}
	}

	/*Função na qual irá mostrar/visualizar
	* o usuário que possui o $id passado
	* por parâmetro.
	*/
	public function show($id){
		$this->usuario_m->editar($id);

		$this->load->view('template/header');
		$this->load->view('usuario/show');
		$this->load->view('template/footer');
	}

	/*Função na qual irá mostrar os acessos que
	* o usuário, com $id igual ao do parâmetro,
	* teve dentro do sistema e redireciona-lo
	* para a lista de acessos.
	*/
	public function acesso($id){
		$this->usuario_m->editar($id);

		$result = $this->acesso_m->listar_usuario($id);
		$data['result'] = $result;

		$this->load->view('template/header');
		$this->load->view('usuario/acesso', $data);
		$this->load->view('template/footer');
	}

	/*Função na qual irá buscar todos usuários
	* conectados no momento, armazena-los na
	* array $data e exibi-los.
	*/
	public function online(){
		$result = $this->online_m->todos();
		$data['result'] = $result;

		$this->load->view('template/header');
		$this->load->view('usuario/online', $data);
		$this->load->view('template/footer');
	}

	/*Função na qual irá listar todas os usuários
	* que estão no banco de dados através da função
	* 'todos' da classe 'usuario_m'.
	*/
	public function listar(){
		$result = $this->usuario_m->todos();
		$data['result'] = $result;

		$this->session->set_userdata('css_js', 'tabela');

		$this->load->view('template/header');
		$this->load->view('usuario/listar', $data);
		$this->load->view('template/footer');

		$this->session->unset_userdata('status');
	}

}
