<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fornecedor extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index(){
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

	public function cadastrarFornecedor(){
		//se nao for enviado nada do formulario, redireciona para a pagina de login
		if( !$this->input->post() )
			redirect( base_url() ."admin/fornecedor" );

		// faz as validações
		$this->form_validation->set_rules("cnpj", "CNPJ", "trim|required|min_length[14]|max_length[14]|is_unique[fornecedores.cnpj]"); // precisa ser único
		$this->form_validation->set_rules("razaoSocial", "Razão Social", "trim|required|max_length[50]");
		$this->form_validation->set_rules("telefone", "Telefone", "trim|required|min_length[10]|max_length[10]");
		$this->form_validation->set_rules("numero", "Número", "trim|required");
		$this->form_validation->set_rules("logradouro", "Logradouro", "trim|required|max_length[30]");
		$this->form_validation->set_rules("cep", "CEP", "trim|required|min_length[8]|max_length[8]");
		$this->form_validation->set_rules("cidade", "Cidade", "trim|required|max_length[30]");
		$this->form_validation->set_rules("estado", "Estado", "trim|required|max_length[30]");
		
		if ( $this->form_validation->run() == TRUE ) {
			$dados['fornecedor'] = $this->input->post('inputFornecedor'); // pega dados do formulário

			try{ // inserção do banco de dados
				$this->fornecedor_model->insert($dados);
				define_flashdata('notificacao_topo', 'sucesso', 'Fornecedor cadastrado com sucesso!');
				redirect( base_url() . 'admin/fornecedor' );
			}catch(Exception $e){
				// define mensagem de erro no envio.
				define_flashdata('notificacao_topo', 'erro', 'Houve um erro ao executar seu cadastro. Por favor, tente novamente em alguns instantes.'.$e.getMessage().'',TRUE);
			}
		
			
		}
		// define mensagem de erro no envio.
		define_flashdata('notificacao_topo', 'erro', 'Houve um erro ao executar seu cadastro. Por favor, tente novamente em alguns instantes.',TRUE);
	}
}
