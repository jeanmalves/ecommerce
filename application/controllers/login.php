<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		//renderiza a pagina
		$dados['title'] = 'Solution Commerce - Login';
		
		$this->breadcrumb->add_crumb('Home', base_url());
		$this->breadcrumb->add_crumb('login', '');
		
		$this->template->build('login', $dados);
	}
	
	// Recebe envio do form de login
	public function autenticaUsuario() {
		
		//se nao for enviado nada, redireciona para a pagina de login
		if( !$this->input->post() )
			redirect( base_url() . "login" );
			
		// executa autentica��o dos dados passados
		$this->load->model('usuario_model');
		$dadosLogin = $this->usuario_model->autenticaLogin( 
			$this->input->post('loginUsuario'),
			md5($this->input->post('loginSenhaUsuario'))
		);
		
		// valida��o do form
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('loginUsuario', '', 'trim|required');
		$this->form_validation->set_rules('loginSenhaUsuario', '', 'trim|required');
		
		if ( $this->form_validation->run() == TRUE ) {
			
			if( $dadosLogin ) {
				$this->session->set_userdata(array(
					'login_nome' => $dadosLogin['USR_NOME'],
					'login_user' => $dadosLogin['USR_LOGIN'],
					'id_user'	=> $dadosLogin['USR_ID']
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