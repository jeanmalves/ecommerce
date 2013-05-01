<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicos extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$dados['title'] = 'Serviços';
		$this->template->build('servicos', $dados);
	}
}
