<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto extends CI_Controller {

	function __construct() {
		parent::__construct();
		//carrega o model. 
		$this->load->model('produto_model');
	}

	function index() {
		$dados = array();
		$slideShow = array();	
		$dados['saudacao']= get_saudacao_admin();
		//Carrega as partes do layout.
			
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url()."admin");
		$this->breadcrumb->add_crumb('Produtos','');
		//titulo da pagina
		$this->template->title('Painel Administrativo - Solution Commerce');
		//header adm.
		$this->template->set_partial('header','layouts/partial/header_admin');
		//menu adm.
		$this->template->set_partial('menu','layouts/partial/menu_admin');
		//menu lateral
		//$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('admin/produto', $dados);
	}
	
	public function formProduto(){
		$dados = array();
		$dados['saudacao']= get_saudacao_admin();
		//Carrega as partes do layout.

		if($this->input->post())
			$this->cadastrarProduto();
			
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url()."admin");
		$this->breadcrumb->add_crumb('Produtos','');
		//titulo da pagina
		$this->template->title('Painel Administrativo - Solution Commerce');
		//header adm.
		$this->template->set_partial('header','layouts/partial/header_admin');
		//menu adm.
		$this->template->set_partial('menu','layouts/partial/menu_admin');
		//menu lateral
		//$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('admin/cad_produto', $dados);
	}
	private function cadastrarProduto(){
		//echo '<pre>'; print_r($this->input->post());die();
		//se nao for enviado nada do formulario, redireciona para a pagina de login
		
		$status = null;	
		$idProduto = null;
		
		//Define o status do registro.
		($this->input->post('optionsRadiosAtivo')== 1)? $status = 'Ativo' : $status = 'Inativo'; 	
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules("inputNome", "Nome", "trim|required");
		$this->form_validation->set_rules("inputDesc", "Descricao", "trim");

		if ( $this->form_validation->run() == TRUE ) {
			
			//campos vindo do formulario
			$dados['nome'] 	 	= $this->input->post('inputNome');
			$dados['descricao']	= $this->input->post('inputDesc');
			$dados['imagem']	= $this->input->post('inputFoto');
			$dados['status']	= $status;
			
			
			try {
				//insere o produto no banco de dados.
				$idProduto = $this->produto_model->insert($dados);
				
				//faz upload da imagem.
				if( upload_imagens_resize('inputFoto', 'fotos', $idProduto) === FALSE ) {
						return false;
				}
				define_flashdata('notificacao_topo', 'sucesso', 'Produto cadastrado com sucesso.');
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
