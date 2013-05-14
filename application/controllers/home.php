<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$dados	   = array();
		$slideShow = array();
		$dados['saudacao']= get_saudacao();

		//monta a paginação
		if( $this->uri->segment(2) && !is_numeric($this->uri->segment(2)) ) {
			$config['uri_segment_search'] = 1;
			$config['uri_segment'] = 2;		
		} 
		$this->load->model('estoque_model');
		$config['per_page']   = '6';
		$config['total_rows'] = count($this->estoque_model->getProdutoComEstoque());
		$config['base_url']	= base_url();
		$this->load->library('pagination', $config);
		$dados['listagem'] = $this->estoque_model->getProdutoComEstoque( $this->pagination->array_limoff(), false );
		$dados['total'] = $config['total_rows'];
		
		$dados['links_paginacao'] = $this->pagination->create_links();

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
		//$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('home', $dados); 
	}
}