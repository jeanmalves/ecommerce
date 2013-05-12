<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		//die();
		//verifica o tipo de login requerido ou se tem permissão para logar.
		checkLoginSistema('sistema');
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
		//header adm.
		$this->template->set_partial('header','layouts/partial/header_admin');
		//menu adm.
		$this->template->set_partial('menu','layouts/partial/menu_admin');
		//menu lateral
		$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('admin/home', $dados); 
	}
}