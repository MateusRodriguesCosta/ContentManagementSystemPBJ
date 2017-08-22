<?php
/* Copyright (C) OSAA, Pousada do Bom Jesus - Todos os Direitos Reservados
* A cópia não autorizada deste arquivo, por meio de qualquer meio, é estritamente proibida
* Confidencial e proprietário
* Escrito por Mateus Costa <mateusespindola25@hotmail.com>, junho de 2017
*/


# Classe será utilizada no período de evolução,
# quando Pousada do Bom Jesus criar twitter próprio.
defined('BASEPATH') OR exit('No direct script access allowed');
class Twitter extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		include_once APPPATH.'libraries/Twitter/Twitteroauth.php';
		include_once APPPATH.'libraries/Twitter/Oauth.php';
		include_once APPPATH.'libraries/Twitter/config.php';

		$url = 'http://migre.me/api.txt?url=http://www.pousadadobomjesus.com';
		$tweetar = substr(trim('Você já conhece o site da Pousada do Bom Jesus? Se não,'), 0, 103).' Veja as mesma aqui: '.$this->texto_m->compactar_url($url);

		$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
		$tweet->post('statuses/update', array('status' => substr($tweetar,0,140), 'source' => 'http://www.pousadadobomjesus.com'));

		var_dump(substr($tweetar,0,140));
	}

	public function tweetar(){
		include_once APPPATH.'libraries/Twitter/Twitteroauth.php';
		include_once APPPATH.'libraries/Twitter/Oauth.php';
		include_once APPPATH.'libraries/Twitter/config.php';

		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
		} else {
			exit;
		}

		if($this->uri->segment(4)){
			$titulo = $this->uri->segment(3);
		} else {
			exit;
		}

		if($this->uri->segment(5)){
			$resumo = $this->uri->segment(3);
		} else {
			exit;
		}

		$url = 'Imprensa/Noticia/'.$id.'-'.$this->texto_m->limpa_url_encode($titulo);
		$tweetar = substr(trim($resumo), 0, 103).'... Saiba mais: '.$this->texto_m->compactar_url($url);

		$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
		$tweet->post('statuses/update', array('status' => substr($tweetar,0,140), 'source' => 'http://www.pousadadobomjesus.com'));

		var_dump(substr($tweetar,0,140));
	}
}
