<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect( base_url() . "home" );
	}
	
	public function busca_cep()
	{
		$cep = $this->input->post('cep');
		$this->load->model('localidade_model');
		
		if ( $cep != null )
		{
		
			$aDadosCep = $this->localidade_model->get_endereco($cep);
			
			if( $aDadosCep )
			{
				
				echo $aDadosCep["CEP"] . ',' . $aDadosCep["ENDERECO"] . ',' . 
					 $aDadosCep["BAIRRO"] . ',' . $aDadosCep["CIDADE"] . ',' . 
					 $aDadosCep["UF"];
					 
			}
			else if (!$aDadosCep)
			{
				$aDadosCepCidade = $this->localidade_model->get_cidade($cep);
				if( $aDadosCepCidade ){	
					echo $aDadosCepCidade["CEP"] . ',' . $aDadosCepCidade["ENDERECO"] . ',' . 
						 "CENTRO" . ',' . $aDadosCepCidade["CIDADE"] . ',' . 
					 	$aDadosCepCidade["UF"];
				}else{
					echo '0';
				}
			}
		}
	}
	public function check_cnpj() {
		$cnpj = formata_cnpj($this->input->post('cnpj'));
		if( $cnpj != '' ) {
			$this->load->model('cliente_model');
			if( $this->cliente_model->existe_cnpj($cnpj) ) echo json_encode(FALSE);
			else echo json_encode(TRUE);
		} else {
			echo json_encode(TRUE);
		}			
	}
	
	public function check_cpf() {
		$cpf = formata_cpf($this->input->post( $this->input->post('campo') ));
		if( $cpf != '' ) {
			$this->load->model('cliente_model');
			if( $this->cliente_model->existe_cpf($cpf) ) echo json_encode(FALSE);
			else echo json_encode(TRUE);
		} else {
			echo json_encode(TRUE);
		}		
	}
	public function valida_cep(){
		$cep = formata_cep( $this->input->post($this->input->post('campo')) );
		
		if ( $cep != '' )
		{
			$this->load->model('localidade_model');
			$aDadosCep = $this->localidade_model->get_endereco($cep);
			
			if( $aDadosCep )
			{
				echo json_encode(TRUE);
			}
			else if (!$aDadosCep)
			{
			$aDadosCepCidade = $this->localidade_model->get_cidade($cep);
				if( $aDadosCepCidade ){	
					echo json_encode(TRUE);
				}else{
					echo json_encode(FALSE);
				}
			}
		}else{
			echo json_encode(TRUE);
		}
	}
}