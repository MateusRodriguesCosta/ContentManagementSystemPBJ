<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Texto_m extends CI_Model {

	public function ativo_icone($ativo) {
		switch($ativo) {
			case '1':
				$ativo_r = '<i title="Sim" class="fa fa-eye text-info"></i>';
			break;
			case '0':
				$ativo_r = '<i title="Não" class="fa fa-eye-slash text-danger"></i>';
			break;
			default:
				$ativo_r = '<i title="Bug" class="fa fa-bug text-alert"></i>';
			break;
		}
		return $ativo_r;
	}

	public function ativo_selecionar($ativo) {
		switch($ativo) {
			case '1':
			case 1:
				$ativo_r = '<option value="1" selected>SIM</option><option value="0">NÃO</option>';
			break;
			case '0':
			case 0:
				$ativo_r = '<option value="1">SIM</option><option value="0" selected>NÃO</option>';
			break;
			default:
				$ativo_r = '<option value="1">SIM</option><option value="0">NÃO</option>';
			break;
		}
		return $ativo_r;
	}

	public function midia_selecionar($opcao) {
		switch($opcao) {
			case 'Página Principal':
				$opcao_r = '<option value="Página Principal" selected>Página Principal</option>
				<option value="A Pousada - Visitas Ilustres">A Pousada - Visitas Ilustres</option>
				<option value="Fé e Lazer - Pousada">Fé e Lazer - Pousada</option>
				<option value="Eventos - Ambientes">Eventos - Ambientes</option>
				<option value="Restaurante">Restaurante</option>';
			break;
			case 'A Pousada - Visitas Ilustres':
				$opcao_r = '<option value="Página Principal">Página Principal</option>
				<option value="A Pousada - Visitas Ilustres" selected>A Pousada - Visitas Ilustres</option>
				<option value="Fé e Lazer - Pousada">Fé e Lazer - Pousada</option>
				<option value="Eventos - Ambientes">Eventos - Ambientes</option>
				<option value="Restaurante">Restaurante</option>';
			break;
			case 'Fé e Lazer - Pousada':
				$opcao_r = '<option value="Página Principal">Página Principal</option>
				<option value="A Pousada - Visitas Ilustres">A Pousada - Visitas Ilustres</option>
				<option value="Fé e Lazer - Pousada" selected>Fé e Lazer - Pousada</option>
				<option value="Eventos - Ambientes">Eventos - Ambientes</option>
				<option value="Restaurante">Restaurante</option>';
			break;
			case 'Eventos - Ambientes':
				$opcao_r = '<option value="Página Principal">Página Principal</option>
				<option value="A Pousada - Visitas Ilustres">A Pousada - Visitas Ilustres</option>
				<option value="Fé e Lazer - Pousada">Fé e Lazer - Pousada</option>
				<option value="Eventos - Ambientes" selected>Eventos - Ambientes</option>
				<option value="Restaurante">Restaurante</option>';
			break;
			case 'Restaurante':
				$opcao_r = '<option value="Página Principal">Página Principal</option>
				<option value="A Pousada - Visitas Ilustres">A Pousada - Visitas Ilustres</option>
				<option value="Fé e Lazer - Pousada">Fé e Lazer - Pousada</option>
				<option value="Eventos - Ambientes">Eventos - Ambientes</option>
				<option value="Restaurante" selected>Restaurante</option>';
			break;
			default:
				$opcao_r = '<option value="Página Principal" selected>Página Principal</option>
				<option value="A Pousada - Visitas Ilustres">A Pousada - Visitas Ilustres</option>
				<option value="Fé e Lazer - Pousada">Fé e Lazer - Pousada</option>
				<option value="Eventos - Ambientes">Eventos - Ambientes</option>
				<option value="Restaurante">Restaurante</option>';
			break;
		}
		return $opcao_r;
	}

	public function conversaoData($data){
		$data = str_replace('/', '-', $data);
		$data = str_replace(' ', '', $data);
		$data = date_create_from_format('d-m-Y', $data);
		$data = date('Y-m-d H:i:s', $data->getTimestamp());
		return $data;
	}

	public function tratarQueryLog($query, $tabela){
		$query = str_replace('!break!', '
', $query);
		$query = str_replace('false', 'NÃO FORAM REALIZADAS EDIÇÕES NA IMAGEM', $query);
		$query = str_replace('true', 'FORAM REALIZADAS EDIÇÕES NA IMAGEM', $query);

		return $query;
	}
	public function verificarConteudo($conteudo){
		if ($conteudo!=null && $conteudo!='') {
			return $conteudo;
		}else {
			return ' - ';
		}
	}

	public function ativo_texto($ativo) {
		switch($ativo){
			case '1':
			case 1:
				$ativo_r = 'SIM';
			break;
			case '0':
			case 0:
				$ativo_r = 'NÃO';
			break;
			default:
				$ativo_r = 'BUG';
			break;
		}
		return $ativo_r;
	}

	public function ativo_codigo($ativo) {
		switch($ativo){
			case '1':
				$ativo_r = '1';
			break;
			case '0':
				$ativo_r = '0';
			break;
			default:
				$ativo_r = 'BUG';
			break;
		}
		return $ativo_r;
	}


	public function alerta($status) {
		switch($status) {
			case 'FORM_ERROR':
				$status_r = '<div class="alert alert-alert pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>';
			break;
			case 'SUCESSO':
				$status_r = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-check pr10"></i><strong>Opera&ccedil;&atilde;o realizada com SUCESSO.</strong></div>';
			break;
			case 'LOGIN_INVALIDO':
				$status_r = '<div class="alert alert-alert pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>Você digitou login ou senha errado.</strong></div>';
			break;
			case 'LOGIN_DESATIVADO':
				$status_r = '<div class="alert alert-danger pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>Seu login está desativado, por favor entre em contato com o T.I.</strong></div>';
			break;
			case 'LOGIN_IP_INVALIDO':
				$status_r = '<div class="alert alert-danger pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>Você não tem permissão de acesso de seu local atual, por favor entre em contato com o T.I.</strong></div>';
			break;
			case 'LOGIN_IP_MUDOU':
				$status_r = '<div class="alert alert-danger pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>Durante a sessão você mudou de local não cadastrado, por favor entre em contato com o T.I.</strong></div>';
			break;
			case 'LOGIN_SUCESSO':
				$status_r = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-check pr10"></i><strong>Seu login foi realizado com SUCESSO.</strong></div>';
			break;
			case 'LOGIN_SAIR':
				$status_r = '<div class="alert alert-primary pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-sign-out pr10"></i><strong>Você deslogou do sistema.</strong></div>';
			break;
			case 'LOGIN_FORA':
				$status_r = '<div class="alert alert-danger pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info pr10"></i><strong>Você não está logado no sistema para ter acesso efetue o login.</strong></div>';
			break;
			case 'LOGIN_EXPULSAR':
				$status_r = '<div class="alert alert-primary pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-sign-out pr10"></i><strong>Você expulsou do sistema o usuário com SUCESSO.</strong></div>';
			break;
			case 'LOGIN_OFF':
				$status_r = '<div class="alert alert-danger pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-sign-out pr10"></i><strong>Você não está mais logado no sistema.</strong></div>';
			break;
			case 'IP_NOVO_LOCAL':
				$status_r = '<div class="alert alert-danger pastel alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-sign-out pr10"></i><strong>Você acabou de cadastrar um novo local.</strong></div>';
			break;
			default:
				$status_r = null;
			break;
		}
		return $status_r;
	}

	public function validacao() {
		$this->form_validation->set_message('required', 'O campo "{field}" é obrigatório!');
		$this->form_validation->set_message('max_length', 'O campo "{field}" deve ter no máximo {param} caracteres!');
		$this->form_validation->set_message('min_length', 'O campo "{field}" deve ter no mínimo {param} caracteres!');
		$this->form_validation->set_message('is_unique', 'O login digitado no campo "{field}" já existe, tente outro!');
		$this->form_validation->set_message('regex_match', 'O campo "{field}" está com formato inválido, tente outro!');
		$this->form_validation->set_message('exact_length', 'O campo "{field}" deve exatamente {param} caracteres!');
		$this->form_validation->set_message('validarAlcance', 'O campo "{field}" está com data inválida, tente novamente!');
		$this->form_validation->set_message('matches', 'O campo "{field}" deve exatamente igual à "{param}"!');
		$this->form_validation->set_message('in_list', 'O campo "{field}" deve ser SIM ou NÃO!');
		$this->form_validation->set_message('valid_email', 'O campo "{field}" deve ser um e-mail válido!');
		$this->form_validation->set_message('is_natural_no_zero', 'O campo "{field}" deve valor numérico natural sem o zero (0)!');
		$this->form_validation->set_message('greater_than_equal_to', 'O campo "{field}" deve contém a data a partir de amanhã!');
	}

	public function ip() {
		return $_SERVER['REMOTE_ADDR'];
	}

	public function host() {
		return gethostbyaddr($_SERVER['REMOTE_ADDR']);
	}

	public function sistema_operacional() {
		$this->load->library('user_agent');
		return $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
	}

	public function navegador() {
		$this->load->library('user_agent');

		if($this->agent->is_browser()) {
			$agent = $this->agent->browser().' '.$this->agent->version();
		} else if($this->agent->is_robot()) {
			$agent = $this->agent->robot();
		} else if($this->agent->is_mobile()) {
			$agent = $this->agent->mobile();
		} else {
			$agent = 'Desconhecido';
		}
		return $agent;
	}

	public function log_painel($operacao) {
		switch($operacao) {
			case 'i':
			case 'c':
				$operacao_r = 'success';
			break;
			case 'u':
			case 'a':
				$operacao_r = 'primary';
			break;
			case 'd':
			case 'e':
				$operacao_r = 'danger';
			break;
			default:
				$operacao_r = 'alert';
			break;
		}
		return $operacao_r;
	}

	public function log_texto($operacao) {
		switch($operacao) {
			case 'i':
			case 'c':
				$operacao_r = 'Inserido / Cadastrado';
			break;
			case 'u':
			case 'a':
				$operacao_r = 'Alteração / Edição';
			break;
			case 'd':
			case 'e':
				$operacao_r = 'Deletado / Excluído';
			break;
			default:
				$operacao_r = 'Bug';
			break;
		}
		return $operacao_r;
	}

	public function nivel_texto($nivel) {
		switch($nivel) {
			case 1:
				$nivel_r = '<span class="label label-danger">Prioridade Total</span>';
			break;
			case 2:
				$nivel_r = '<span class="label label-warning">Alta</span>';
			break;
			case 3:
				$nivel_r = '<span class="label label-alert">Normal</span>';
			break;
			case 4:
				$nivel_r = '<span class="label label-success">Baixo</span>';
			break;
			case 5:
				$nivel_r = '<span class="label label-default">Desnecessario</span>';
			break;
			default:
				$nivel_r = '<span class="label label-dark">Indefinido</span>';
			break;
		}
		return $nivel_r;
	}

	public function status_icone($status) {
		switch($status) {
			case 1:
				$status_r = '<span class="fa fa-clock-o text-muted"></span>';
			break;
			case 2:
				$status_r = '<span class="fa fa-spinner fa-spin text-system"></span>';
			break;
			case 3:
				$status_r = '<span class="fa fa-check text-info"></span>';
			break;
			case 4:
				$status_r = '<span class="fa fa-folder-open-o text-success"></span>';
			break;
			case 5:
				$status_r = '<span class="fa fa-pencil-square-o text-warning"></span>';
			break;
			default:
				$status_r = '<span class="fa fa-bug text-dark"></span>';
			break;
		}
		return $status_r;
	}

	public function status_blockquote($status) {
		switch($status) {
			case 1:
				$status_r = 'blockquote-muted';
			break;
			case 2:
				$status_r = 'blockquote-system';
			break;
			case 3:
				$status_r = 'blockquote-info';
			break;
			case 4:
				$status_r = 'blockquote-success';
			break;
			case 5:
				$status_r = 'blockquote-warning';
			break;
			default:
				$status_r = 'blockquote-dark';
			break;
		}
		return $status_r;
	}

	public function sqlinjection($texto) {
		$procurar = array("'",'"','\\',' or ',' and ');
		return str_replace($procurar, '', $texto);
	}

	public function acesso_texto($acesso) {
		switch($acesso) {
			case 1:
				$acesso_r = '<span class="label label-danger"><i class="fa fa-times"></i> Login Inválidos!</span>';
			break;
			case 2:
				$acesso_r = '<span class="label label-danger"><i class="fa fa-times"></i> Senha Inválidos!</span>';
			break;
			case 3:
				$acesso_r = '<span class="label label-danger"><i class="fa fa-times"></i> Login Desativado!</span>';
			break;
			case 4:
				$acesso_r = '<span class="label label-warning"><i class="fa fa-times"></i> IP Desconhecido!</span>';
			break;
			case 5:
				$acesso_r = '<span class="label label-success"><i class="fa fa-sign-in"></i> Acesso Concedido!</span>';
			break;
			case 6:
				$acesso_r = '<span class="label label-info"><i class="fa fa-sign-in"></i> Reconectou!</span>';
			break;
			case 7:
				$acesso_r = '<span class="label label-default"><i class="fa fa-sign-out"></i> Efetuou Logout!</span>';
			break;
			case 8:
				$acesso_r = '<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i> Estava Logado e Teve Login Desativado!</span>';
			break;
			case 9:
				$acesso_r = '<span class="label label-alert"><i class="fa fa-exclamation-triangle"></i> Durante a sessão trocou de local!</span>';
			break;
			default:
				$acesso_r = '<span class="label label-dark"><i class="fa fa-bug"></i> Indefinido</span>';
			break;
		}
		return $acesso_r;
	}

	public function limpeza_sql($texto) {
		return str_replace('\"', '"', $texto);
	}

	/*public function caminho_salvar($local = '') {
		if($_SERVER['SERVER_NAME'] == '172.16.101.133' && $local == '') {
			$caminho = '../AdministracaoSitePousadaBomJesus';
		} else if($_SERVER['SERVER_NAME'] == '172.16.101.133' && $local != '') {
			$caminho = '.';
		} else {
			$caminho = '../httpdocs';
		}
		return $caminho;
	}*/

	public function caminho_salvar($local = '') {
		if($_SERVER['SERVER_NAME'] == '172.16.101.133' && $local == '') {
			$caminho = '../SitePousadaBomJesus';
		} else if($_SERVER['SERVER_NAME'] == '172.16.101.133' && $local != '') {
			$caminho = '.';
		} else {
			$caminho = '../httpdocs';
		}
		return $caminho;
	}

	public function url_arquivo($arquivo) {
		if($_SERVER['SERVER_NAME'] == '172.16.101.133') {
			//$caminho = base_url($arquivo);
			$caminho = 'http://pousadadobomjesus.com'.$arquivo;
		} else {
			$caminho = 'http://pousadadobomjesus.com'.$arquivo;
		}
		return $caminho;
	}

	public function limpa_url($texto) {
		$procurar = array('!','@','$','%','&','*','(',')','=','+','[',']','|',',',';');
		return str_replace($procurar, '', $texto);
	}

	public function limpa_url_encode($texto) {
		$procurar = array('!','@','$','%','&','*','(',')','=','+','[',']','|',',',';');
		return urlencode(str_replace($procurar, '', $texto));
	}

	public function migra_me_url($url) {
		return 'http://migre.me/api.txt?url=http://pousadadobomjesus.com/'.$url;
	}

	public function compactar_url($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		curl_close($curl);

		if($data) {
			//echo $data;
			return $data;
		} else {
			//echo 'Erro';
			return null;
		}
	}
}
?>
