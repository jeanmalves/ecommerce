<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * My Utility Helpers
 *
 * @category	Helpers
 * @author		Rafael Dantas
 */

// ------------------------------------------------------------------------

/**
 * Exibe Flashdata
 *
 * Identifica e exibe uma mensagem ativa definida pela fun��o
 * define_flashdata()
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('exibe_flashdata')) {
	function exibe_flashdata($nome) {
		
		$ci =& get_instance();
		
		// Obtem mensagem de acordo com a maneira em que foi armazenada na fun��o define_flashdata()
		$msg = $ci->session->userdata('new:'.$nome); 
		if( $msg ) {
			// remove imediatamente para n�o correr o risco de reaparecer na pr�xima requisi��o
			$ci->session->unset_userdata('new:'.$nome);
		} else {
			$msg = $ci->session->flashdata($nome);	
		}
	
		$html = '';
		if (is_array($msg)) {
			if( $nome == 'notificacao_topo' ) {
				$html = '<div class="notification '.$msg['tipo'].'">
							 <p><strong>'.$msg['msg'].'</strong></p>
						 </div>';
			}
			elseif( $nome == 'notificacao_parag' ) {
				$html = '<p class="'.$msg['tipo'].'">'.$msg['msg'].'</p>';
			}
			else {
				$html = $msg['msg'];
			}
		}
		return $html;
	}  
}

// ------------------------------------------------------------------------

/**
 * Define Flashdata
 *
 * Define na sess�o uma mensagem que ser� visualizada na 
 * pr�xima requisi��o desde que chamada pela fun��o
 * exibe_mensagem_notificacao().
 * � poss�vel for�ar a visualiza��o da mensagem na atual 
 * requisi��o, definindo a vari�vel $atual_req como true
 *
 * @access	public
 * @param	string
 * @param	string
 * @param 	bool
 * @return	void
 */
if ( ! function_exists('define_flashdata')) {
	function define_flashdata($nome, $tipo, $msg, $atual_req = FALSE) {
		
		$ci =& get_instance();
		$tipo = ($tipo=='sucesso'?'success':($tipo=='erro'?'error':($tipo=='informacao'?'information':'information')));
		$arr_dados = array(
			'msg'  	 => $msg,
			'tipo' 	 => $tipo
		);
		
		// Se true, for�a a visualiza��o da mensagem na requisi��o atual
		if( $atual_req == TRUE ) {
			$ci->session->set_userdata('new:'.$nome, $arr_dados);
		} 
		// Caso contr�rio, armazena a mensagem em flashdata, que ser� visualizada na pr�xima requisi��o
		else {
			$ci->session->set_flashdata($nome, $arr_dados);
		}
	}  
}

// ------------------------------------------------------------------------

/**
 * Get Array
 *
 * Retorna um array específico fixo do sistema
 *
 * @access	public
 * @param	string
 * @return	array
 */
if ( ! function_exists('get_array')) {
	function get_array($nome_array) {
		$ci =& get_instance();
		$array = $ci->config->item('array');
		return (isset($array[$nome_array]) ? $array[$nome_array] : FALSE);
	}  
}

// ------------------------------------------------------------------------

/**
 * Get Array Dropdown
 *
 * Retorna um array com valores para serem usados em menu dropdown
 *
 * @access	public
 * @param	string
 * @return	array
 */
if ( ! function_exists('get_array_dropdown')) {
	function get_array_dropdown($nome) {		
		$array_dropdown = get_array('default_dropdown');
		$array_dropdown += get_array($nome);		
		return $array_dropdown;
	}  
}

// ------------------------------------------------------------------------

/**
 * Get Mensagem
 *
 * Retorna uma mensagem pr�-definida em config/default_values.php
 *
 * @param 	string
 * @access	public
 * @return	string
 */
if ( ! function_exists('get_mensagem')) {
	function get_mensagem($msg_chave) {
		$ci =& get_instance();
		$array = $ci->config->item('mensagem');
		return (isset($array[$msg_chave]) ? $array[$msg_chave] : FALSE);
	}  
}

// ------------------------------------------------------------------------

/**
 * Monta Tabela Listagem
 *
 * Monta uma tabela para listagem de dados
 *
 * @param 	array	$dhead dados <thead>
 * @param 	array	$dbody dados <tbody>
 * @access	public
 * @return	string
 */
if ( ! function_exists('monta_tabela_listagem')) {
	function monta_tabela_listagem($dhead, $dbody) {
		
		$html = '<form class="table-form"><table><thead><tr>';
		foreach( $dhead as $k => $v ) {
			$html .= "<th>{$v}</th>";
		}
		$html .= '</tr></thead><tbody>';
		foreach( $dbody as $k => $v ) {
			$html .= '<tr>';
			foreach( $v as $k2 => $v2 ) {
				$html .= "<td>{$v2}</td>";
			}
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		
		return $html;		
	}  
}

// ------------------------------------------------------------------------

/**
 * Get Action Options
 *
 * Retorna uma string contendo uma estrutura <ul>
 * com as opções da coluna 'Ações' da listagem
 * de uma tabela
 *
 * @param 	array	$options ('insert','edit','delete') - cada opção deve
 * conter um link para acesso
 * @param 	string	$link_edit dados <tbody>
 * @access	public
 * @return	string
 */
if ( ! function_exists('get_action_options')) {
	function get_action_options($options = array()) {
		if( !empty($options) && is_array($options) && 
		(array_key_exists('insert', $options) || array_key_exists('edit', $options) ||
		array_key_exists('delete', $options)) ) {
			$html = '<ul class="actions">';
			foreach( $options as $k => $v ) {
				$title = ($k=='insert'?'Inserir':($k=='edit'?'Editar':'Remover'));
				$html .= '<li><a class="'. $k .'" href="'. $v .'" rel="tooltip" original-title="'. $title .'">'. $title .'</a></li>';
			}
			$html .= '</ul>';
			return $html;
		}
		return '';		
	}  
}

// ------------------------------------------------------------------------

/**
 * Formata CPF
 *
 * Retorna uma string com o CPF formatado de acordo com a m�scara 
 * quest�o. Fun��o espec�fica para layout do QUE
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('formata_cpf')) {
	function formata_cpf($cpf) {
		$cpf2 = preg_replace("/[^0-9]/", "", $cpf);
		if( strlen($cpf2) == 11 )
			return substr($cpf2, 0, 3) . "." . substr($cpf2, 3, 3) . "." . substr($cpf2, 6, 3) . "-" . substr($cpf2, 9, 2);
		return $cpf;		
	}  
}

/**
 * Formata CEP
 *
 * Retorna uma string com o CPF formatado de acordo com a máscara 
 * questão. Função específica para layout do QUE
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('formata_cep')) {
	function formata_cep($cep) {
		$cep2 = preg_replace("/[^0-9]/", "", $cep);
		if( strlen($cep2) == 8 )
			return substr($cep2, 0, 2) . "." . substr($cep2, 2, 3) . "-" . substr($cep2, 5, 3);
		return $cep;		
	}  
}

/**
 * valida login
 *
 * 
 *
 *
 * @access	public
 * @return	string
 */
if ( ! function_exists('checkLogin')) {
	function checkLoginCliente($tipo_login) {
		$ci =& get_instance();
		
	  $tipo_logado = $ci->session->userdata('tipo_user');
                if( $tipo_logado ) {
                        if( $tipo_logado == 1 && $tipo_login == 'sistema' ) {
                                define_flashdata('notificacao_topo', 'info', 'Voc� n�o tem permiss�o para acessar esta �rea!');
                                redirect( base_url() . 'area-cliente/login' );
                        } 
                        elseif( $tipo_logado == 2 && $tipo_login == 'loja' ) {
                                define_flashdata('notificacao_topo', 'info', 'Voc� n�o tem permiss�o para acessar esta �rea!');
                                redirect( base_url() . 'area-cliente/login' );
                        }
                }
                else {
                        define_flashdata('notificacao_topo', 'info', 'Voc� precisa estar logado para acessar esta �rea!');
                        $ci->session->set_userdata('login_redirect', $ci->uri->uri_string());
                        redirect( base_url());               
                }
	}
}	
/*
 * @access	public
 * @return	string
 */
if ( ! function_exists('checkLoginSistema')) {
	function checkLoginSistema($tipo_login) {
		$ci =& get_instance();
		
	  $tipo_logado = $ci->session->userdata('tipo_user');
                if( $tipo_logado ) {
                        if( $tipo_logado == 1 && $tipo_login == 'sistema' ) {
                                define_flashdata('notificacao_topo', 'info', 'Voc� n�o tem permiss�o para acessar esta �rea!');
                                redirect( base_url() . 'area-cliente/login' );
                        } 
                        elseif( $tipo_logado == 2 && $tipo_login == 'loja' ) {
                                define_flashdata('notificacao_topo', 'info', 'Voc� n�o tem permiss�o para acessar esta �rea!');
                                redirect( base_url() . 'admin/login' );
                        }
                }
                else {
                        define_flashdata('notificacao_topo', 'info', 'Voc� precisa estar logado para acessar esta �rea!');
                        $ci->session->set_userdata('login_redirect', $ci->uri->uri_string());
                        redirect( base_url()."admin/login");               
                }
	}
}	

// ------------------------------------------------------------------------

/**
 * Upload de Arquivos 
 *
 * Faz upload de arquivos 
 *
 * @access	public
 * @param string string('campo','fotos') string('produtos','documentos') 
 * @return	boolean
 */
if ( ! function_exists('upload_arquivo')) 
{
	function upload_arquivo($campo, $tipo='texto', $area= 'produtos' ,$id=null) 
	{
		$ci = &get_instance();
		
		if( $tipo != 'texto' && $tipo != 'fotos' ) return FALSE;
		//if( $area != 'produtos' && $area != 'documentos' ) return FALSE;
		
		if( $_FILES[$campo]['error'] == 0 ) {

			$config['upload_path'] = './arquivos/' . $area . '/' . $tipo;
			$config['max_size']	= '2048'; // 2MB
			$config['overwrite'] = TRUE;
			
			if( $id != null ) {
				$config['file_name'] = md5($id) .strstr($_FILES[$campo]['name'],'.');
				
			} 
			
			if( $tipo == 'texto' ) {
				$config['allowed_types'] = 'doc|docx|pdf';
			}
			elseif( $tipo == 'foto' ) {
				$config['allowed_types'] = 'jpg|jpeg|png|gif';
				
				if( $area == 'produtos' ) {
					$config['max_width']  	 = '118';
					$config['max_height']    = '130';
					
				}
			}
			
			$ci->load->library('upload', $config);
				
			if ( !$ci->upload->do_upload($campo)) {
				
				define_flashdata('notificacao_topo', 'erro', 'Erro ao fazer upload de arquivo: '.$ci->upload->display_errors(), TRUE);
				return FALSE;
			}
			
			return TRUE;
		}
		
		return NULL;
	}  
}

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

/**
 * Upload de Imagens 1
 *
 * Faz upload de imagens para empresas logomarca, para candidatos fotos do curr�culo
 *
 * @access	public
 * @param string, string('curriculum','foto') string boolean
 * @return	boolean
 */
if ( ! function_exists('upload_imagens_resize')) 
{
	function upload_imagens_resize($campo, $arquivo='foto', $id=null) 
	{
		$ci = &get_instance();
		
		if( $_FILES[$campo]['error'] == 0 ) {
		
			// define configs para upload
			$config['upload_path'] 	= './arquivos/temp';
			$config['max_size']		= '2048'; // 2MB
			$config['file_name'] 	= md5($_FILES[$campo]['name'] . time()) .'.jpg';
			
			if( $arquivo == 'texto' )
				$config['allowed_types'] = 'doc|docx|pdf';
			elseif( $arquivo == 'foto' )
				$config['allowed_types'] = 'jpg';				
			else return 'erro|Arquivo n�o permitido';
			
			// carrega configs do upload e o executa
			$ci->load->library('upload', $config);				
			if( !$ci->upload->do_upload($campo)) {
				
				// erro no upload
				return 'erro|'. $ci->upload->display_errors();
								
			} else {
		
					// configs para resize
					$config = array();
					$config['source_image'] 	= $ci->upload->upload_path . $ci->upload->file_name;
					$config['new_image'] = './arquivos/cidades/foto/'. md5($id) .'.jpg';
			        $config['maintain_ratio'] 	= TRUE;
			        $config['quality'] 			= '100%';
			        $config['width'] 			= 190;
			        $config['height'] 			= 143;
		    	    
			        // carrega configs do image_lib e executa o resize
		    	    $ci->load->library('image_lib', $config);		    	    
					if( !$ci->image_lib->resize()) {
			        	
						// erro no resize
						return 'erro|'. $ci->image_lib->display_errors();							           
			        }
				} 
				return 'sucesso|'. $ci->upload->file_name;			
			}
			return 'erro|Erro n�o esperado. Tente novamente com menor arquivo.';
		}
}  
if ( ! function_exists('get_saudacao')) {
	function get_saudacao() {
		$ci =& get_instance();
		$usuario = $ci->session->userdata('login_user');
		$tipo 	 = $ci->session->userdata('tipo_user');
		//caso encontre a sessão exibe a saudação, caso contrario exibe mensagem padrao para acesso.

		if($usuario){
			if($tipo == 1){
				$saudacao = '<p><small> Olá '.$usuario.'!   <a href="'.base_url().'area-cliente/logout">Encerrar sessão</a> </small></p>';
			}
		}
		else{
			$saudacao = '<p><small> <a href="'.base_url().'area-cliente/login">Acesse sua área</a> ou <a href="'.base_url().'cadastro">cadastre-se</a> </small></p>';
		}
		
		return $saudacao;
	}
}
//saudação da area administrativa
if ( ! function_exists('get_saudacao_admin')) {
	function get_saudacao_admin() {
		$ci =& get_instance();
		$usuario = $ci->session->userdata('login_user');
		$tipo 	 = $ci->session->userdata('tipo_user');
		//caso encontre a sessão exibe a saudação, caso contrario exibe mensagem padrao para acesso.

		if($usuario){
			if ($tipo == 2){
				$saudacao = '<p><small>  Olá '.$usuario.'!   <a href="'.base_url().'admin/sair">Sair do sistema</a></small> </p>';
			}
		}
		else{
			$saudacao = '<p><small>  <a href="'.base_url().'admin/login">Clique aqui e acesse o sistema</a></small> </p>';
		}
		return $saudacao;
	}
}

/**
 * Converte Data
 * 
 * Converte data de 00/00/0000 para 0000-00-00 ou vice-versa 
 *
 * @access	public
 * @param data string
 * @return	string - data no novo formato
 */
if ( ! function_exists('converte_data')) {
	function converte_data($data){
		
	//Verifica o tipo da data
		
	  if (strlen($data) == 14){
		
		  //quebrando uma data timestamp
	
		  $output = substr($data,6,2) . '/' . substr($data,4,2) . '/' . substr($data,0,4);
		
		  return $output;		
	  }
	  else		
	  {
		
		  if((strstr($data, "-")) && (strlen($data)==10)){
	
			$arrdata = explode ("-", $data);
	
			return $arrdata[2] . "/" . $arrdata[1] . "/" . $arrdata[0];  
	
		  }
		
		  else if((strstr($data, "/")) && (strlen($data)==10)){
	
		  $arrdata = explode ("/", $data);
	
		  return $arrdata[2] . "-" . $arrdata[1] . "-" . $arrdata[0];    
	
		  }
			  
	  	  // se for datetime
		  else if((strstr($data, "-")) && (strlen($data)==19)){
	
			return substr($data,8,2) . '/' . substr($data,5,2) . '/' . substr($data,0,4) . ' ' . substr($data,10);
	
		  }
		  else
		  {
		 	 return $data;
		  }
	
	  }
		
	}
}	

/* Formata Data
 * 
 * Transforma uma data nos formatos ano-mes-dia, mes/dia/ano
 */
if ( ! function_exists('formata_data')) {
	
	function formata_data($data){
		
		if($data){
			$novaData = "";
			$novaData = explode("-", $data);
			$novaData = $novaData[1]."/".$novaData[2]."/".$novaData[0];	
		}
		return $novaData;
	}
}
