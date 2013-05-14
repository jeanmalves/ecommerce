<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estoque extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		//carrega o model. 
		$this->load->model('estoque_model');
	}

	function index()
	 {
		$dados = array();	
		$dados['saudacao']= get_saudacao_admin();
		
		//monta a paginação
		if( $this->uri->segment(2) && !is_numeric($this->uri->segment(2)) ) {
			$config['uri_segment_search'] = 3;
			$config['uri_segment'] = 4;		
		} 
		
		$config['per_page']   = '6';
		$config['total_rows'] = count($this->estoque_model->getProdutoEstoque());
		$config['base_url']	= base_url()."admin/estoque";
		$this->load->library('pagination', $config);
		$dados['listagem'] = $this->estoque_model->getProdutoEstoque( $this->pagination->array_limoff(), false );
		$dados['total'] = $dados['listagem']['total'];
		unset($dados['listagem']['total']);
		$dados['links_paginacao'] = $this->pagination->create_links();
		
		
		//echo '<pre>';print_r($dados['listagem']);die();
		
		//Carrega as partes do layout.	
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url()."admin");
		$this->breadcrumb->add_crumb('Estoque','');
		//titulo da pagina
		$this->template->title('Painel Administrativo - Solution Commerce');
		//header adm.
		$this->template->set_partial('header','layouts/partial/header_admin');
		//menu adm.
		$this->template->set_partial('menu','layouts/partial/menu_admin');
		//menu lateral
		//$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('admin/estoque', $dados);
	}
	public function estoqueView()
	{
		$dados = array();

		//carrega o model do produto.
		$this->load->model('produto_model');
		  
		$dados['saudacao']= get_saudacao_admin();
		
		//monta o array pra exibir no select.
		$dados['produto'] = $this->produto_model->getProdutoDropdown();	
		
		if($this->input->post())
			$this->cadastrarEstoque();
			
		//Carrega as partes do layout.	
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url()."admin");
		$this->breadcrumb->add_crumb('Estoque','');
		//titulo da pagina
		$this->template->title('Painel Administrativo - Solution Commerce');
		//header adm.
		$this->template->set_partial('header','layouts/partial/header_admin');
		//menu adm.
		$this->template->set_partial('menu','layouts/partial/menu_admin');
		//menu lateral
		//$this->template->set_partial('sidebar','layouts/partial/sidebar'); 
		//constroi o template.
		$this->template->build('admin/cad_estoque', $dados);
	}
	
	private function cadastrarEstoque()
	{
		//Faz a validação do formulario.
		$this->load->library('form_validation');
		$this->form_validation->set_rules("inputProduto", "Produto", "trim|required");
		$this->form_validation->set_rules("inputQtde", "Quantidade", "trim|required");
		$this->form_validation->set_rules("inputMin", "Estoque mínimo", "trim|required");
		$this->form_validation->set_rules("inputPreco", "Preço", "trim|required");
		
		if ( $this->form_validation->run() == TRUE ) 
		{
			//campos vindo do formulario
			$dados['idProduto']		= $this->input->post('inputProduto');
			$dados['quantidade']	= $this->input->post('inputQtde');
			$dados['estoqueMinimo']	= $this->input->post('inputMin');
			$dados['preco']			= $this->input->post('inputPreco');
			
			$this->estoque_model->insert($dados);
			//verifica se foi inserido no banco de dados.
			if($this->db->affected_rows() > 0){
			
				define_flashdata('notificacao_topo', 'alert-success', 'Produto cadastrado com sucesso.');
				redirect( base_url() . 'admin/estoque/cadastrar-estoque' );
			
			} else {
				
				// define mensagem de erro no cadastro.
				define_flashdata('notificacao_topo', 'alert-error', 'Houve um erro ao executar seu cadastro. Por favor, tente novamente em alguns instantes.',TRUE);
			}
			
		}
		
		// define mensagem de erro no envio.
		define_flashdata('notificacao_topo', 'alert-error', 'Houve um erro ao executar seu cadastro. Por favor, tente novamente em alguns instantes.',TRUE);
	}
}
	
