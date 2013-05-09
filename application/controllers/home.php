<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$dados['title'] = 'Home';
		
		//adiciona um caminho na breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url());
		$this->template->build('home', $dados);
		
	}
}