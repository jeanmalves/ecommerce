<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$dados = array();
		$slideShow = array();
		$dados['conteudo'] = 'ok';	
		
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
	
	function cadastrarProduto(){
		$this->load->helper("form");
		$this->form_validation->set_rules("nome", "Nome", "trim|required"));
		$this->form_validation->set_rules("descricao", "Descricao", "trim|required"));
		$this->form_validation->set_rules("status", "Status", "trim|required");
		$this->form_valiadtion->set_rules("imagem", "Imagem", "trim");

		if()

	}
}
