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
		
		//monta a paginação
		if( $this->uri->segment(2) && !is_numeric($this->uri->segment(2)) ) {
			$config['uri_segment_search'] = 3;
			$config['uri_segment'] = 4;		
		} 
		
		$config['per_page']   = '6';
		$config['total_rows'] = count($this->produto_model->getProdutos());
		$config['base_url']	= base_url()."admin/produto";
		$this->load->library('pagination', $config);
		$dados['listagem'] = $this->produto_model->getProdutos( $this->pagination->array_limoff(), false );
		$dados['total'] = $config['total_rows'];
		
		$dados['links_paginacao'] = $this->pagination->create_links();
		
		
		
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
	
	public function produtoView(){
		$dados = array();
		$dados['saudacao']= get_saudacao_admin();
		
		if($this->input->post())
			$this->cadastrarProduto();
			
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
		$this->template->build('admin/cad_produto', $dados);
	}
	private function cadastrarProduto(){

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
			$dados['status']	= $status;
			$fotos = $_FILES;
			
			//insere o produto no banco de dados.
			if($idProduto = $this->produto_model->insert($dados)){
				//faz upload da imagem.
				$bool = upload_imagens_resize('file','produtos',$idProduto);
				if( $bool === FALSE ) {
					// define mensagem de erro no envio.
					define_flashdata('notificacao_topo', 'alert-error', "Houve um erro ao cadastrar a foto.",TRUE);
						return false;
				}
				define_flashdata('notificacao_topo', 'alert-success', 'Produto cadastrado com sucesso.');
				redirect( base_url() . 'admin/produto/cadastrar-produto' );
			
			} 
			redirect( base_url() . 'admin/produto/cadastrar-produto' );
				// define mensagem de erro no envio.
				define_flashdata('notificacao_topo', 'alert-error', 'Houve um erro ao executar seu cadastro. Por favor, tente novamente em alguns instantes.',TRUE);	

		}
	}
}
