<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagseguro {	
	
	private $url = '';
	private $data = array();
	private $ci = null;
	
	function __construct($dados = array()){
		
		$this->ci = &get_instance();
		
		$this->url 	= 'https://ws.pagseguro.uol.com.br/v2/checkout';
		
		$this->ci->load->config('pagseguro');
		$this->data['email']= $this->ci->config->item('email_pagseguro');
		$this->data['token']= $this->ci->config->item('token_pagseguro');
		$this->data = $dados;
	}
	
	
}