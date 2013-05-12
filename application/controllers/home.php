<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$dados	   = array();
		$slideShow = array();
		$dados['saudacao']= get_saudacao();

		//$dados['conteudo']= 'conteudo';

		//Carrega as partes do layout.
			
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url());
		//titulo da pagina
		$this->template->title('Home - Solution Commerce');
		//header loja.
		$this->template->set_partial('header','layouts/partial/header');
		//menu loja
		$this->template->set_partial('menu','layouts/partial/menu');
		//slideshow jquery
		$this->template->set_partial('slideshow','layouts/partial/slideshow'); 
		//menu lateral
		$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('home', $dados); 
	}
}