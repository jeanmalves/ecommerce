<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$dados = array();
		//saudação
		$dados['saudacao']= get_saudacao_admin();

		//Carrega as partes do layout.
			
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url());
		//titulo da pagina
		$this->template->title('Painel Administrativo - Solution Commerce');
		//menu lateral
		$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('admin/home', $dados); 
	}
}