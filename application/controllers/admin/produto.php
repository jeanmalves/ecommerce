<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$dados = array();
		$slideShow = array();	
		$dados['saudacao']= get_saudacao_admin();
		//Carrega as partes do layout.
			
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url());
		//titulo da pagina
		$this->template->title('Painel Administrativo - Solution Commerce');
		//header adm.
		$this->template->set_partial('header','layouts/partial/header_admin');
		//menu lateral
		$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('admin/home', $dados);
	}
	
	private function cadastrarProduto(){
		
		//se nao for enviado nada do formulario, redireciona para a pagina de login
		if( !$this->input->post() )
			redirect( base_url() ."admin/produto" );
			
		$this->form_validation->set_rules("nome", "Nome", "trim|required");
		$this->form_validation->set_rules("descricao", "Descricao", "trim|required");
		$this->form_validation->set_rules("status", "Status", "trim|required");
		$this->form_valiadtion->set_rules("imagem", "Imagem", "trim");

		if ( $this->form_validation->run() == TRUE ) {
			
			//campos vindo do formulario
			$dados['produto'] 	 	= $this->input->post('inputProduto');
			
			try {
				//insere o produto no banco de dados.
				$this->produto_model->insert($dados);
				define_flashdata('notificacao_topo', 'sucesso', 'Cidade alterada com sucesso.');
				redirect( base_url() . 'admin/produto' );
				
			} catch (Exception $e) {
				// define mensagem de erro no envio.
				define_flashdata('notificacao_topo', 'erro', 'Houve um erro ao executar seu cadastro. Por favor, tente novamente em alguns instantes.'.$e.getMessage().'',TRUE);
			}
			
		}
		// define mensagem de erro no envio.
		define_flashdata('notificacao_topo', 'erro', 'Houve um erro ao executar seu cadastro. Por favor, tente novamente em alguns instantes.',TRUE);
	}
}
