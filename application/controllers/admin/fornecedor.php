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
		$this->form_validation->set_rules("cnpj", "CNPJ", "trim|required|exact_length[14]|is_unique[fornecedores.cnpj]|numeric "); // precisa ser único
		$this->form_validation->set_rules("razaoSocial", "Razão Social", "trim|required|max_length[50]");
		$this->form_validation->set_rules("telefone", "Telefone", "trim|required|exact_length[10]|numeric");
		$this->form_validation->set_rules("email", "Email", "trim|required|max_length[30]|valid_email");
		$this->form_validation->set_rules("numero", "Número", "trim|required|numeric");
		$this->form_validation->set_rules("logradouro", "Logradouro", "trim|required|max_length[30]");
		$this->form_validation->set_rules("cep", "CEP", "trim|required|exact_length[8]|numeric");
		$this->form_validation->set_rules("cidade", "Cidade", "trim|required|max_length[30]");
		$this->form_validation->set_rules("estado", "Estado", "trim|required|max_length[30]");
		
		if ( $this->form_validation->run() == TRUE ) {
			// pega dados do formulário e coloca no vetor de dados
			$dados['fornecedor'] = $this->input->post('inputFornecedor'); // pega dados do formulário
			$dados['fornec_cnpj'] = $this->input->post('cnpj'); // cnpj
			$dados['fornec_razaoSocial'] = $this->input->post('razaoSocial'); // razao social
			$dados['fornec_telefone'] = $this->input->post('telefone'); // telefone
			$dados['fornec_email'] = $this->input->post('email'); // email
			$dados['fornec_numero'] = $this->input->post('numero'); // numero
			$dados['fornec_logradouro'] = $this->input->post('logradouro'); // logradouro
			$dados['fornec_cep'] = $this->input->post('cep'); // cep
			$dados['fornec_cidade'] = $this->input->post('cidade'); // cidade
			$dados['fornec_estado'] = $this->input->post('estado'); // estado

			try{ // inserção do banco de dados
				$this->fornecedor_model->insert($dados);
				define_flashdata('notificacao_topo', 'sucesso', 'Fornecedor cadastrado com sucesso!'); // mostra mensagem de sucesso
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
