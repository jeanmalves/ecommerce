<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		//saudação
		$dados['saudacao']= get_saudacao();
		
		//breadcrumb
		$this->breadcrumb->add_crumb('Home', base_url());
		$this->breadcrumb->add_crumb('login', '');
		
		//titulo da pagina
		$this->template->title('Home - Solution Commerce');
		//menu loja
		$this->template->set_partial('menu','layouts/partial/menu');
		//constroi o layout na pagina.
		$this->template->build('login', $dados);
	}
	
	// Recebe envio do form de login
	public function autenticaUsuario() {

		//se nao for enviado nada, redireciona para a pagina de login
		if( !$this->input->post() )
			redirect( base_url() . "area-cliente/login" );
			
		// executa autentica��o dos dados passados
		$this->load->model('usuario_model');
		$dadosLogin = $this->usuario_model->autenticaLogin( 
			$this->input->post('inputLogin'),
			md5($this->input->post('inputPassword')),
			1
		);
		
		// valida��o do form
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('inputLogin', '', 'trim|required');
		$this->form_validation->set_rules('inputPassword', '', 'trim|required|min_length[6]');
		
		if ( $this->form_validation->run() == TRUE ) {
			
			if( $dadosLogin ) {
				$this->session->set_userdata(array(
					'login_nome' => $dadosLogin['usr_nome'],
					'login_user' => $dadosLogin['usr_login'],
					'id_user'	=> $dadosLogin['usr_id'],
					'tipo_user'	=> $dadosLogin['usr_tipo']
				));	
				//redireciona para a pagina principal
				redirect( base_url());
			} else {
				//mensagem de erro
				define_flashdata('notificacao_parag', 'erro', 'Usuário ou senha Inválido!', TRUE);
			}
			
		}
		$this->index();	
	}
	
	public function sair() {
		
		// removendo sess�o
		$this->session->unset_userdata(array(
			'login_nome' => '',
			'login_user' => '',
			'id_user'	 => ''
		));
		//exibe mensagem de logout.	
		define_flashdata('notificacao_topo', 'sucesso', 'Logout realizado com sucesso!');		
		//redireciona para pagina principal
		redirect( base_url());
	}
}