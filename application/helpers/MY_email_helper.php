<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Email Helper
 *
 * @category	Helpers
 * @author		Rafael Dantas
 */

// ------------------------------------------------------------------------

/**
 * Get Saudação Candidato
 *
 * Retorna uma string com saudação para visitante se não estiver logado, 
 * ou de acordo com o tipo de usuário que estiver logado e com cores
 * específicas de candidato ou empresa
 *
 * @param   string 'candidato' ou 'empresa'
 * @access	public
 * @return	string
 */
if ( ! function_exists('envia_email')) {
	function envia_email($options=array()) {
		if( is_array($options) || count($options) > 0 ) {
			
			$ci =& get_instance();
			
			if( !isset($options['para']) || !isset($options['tema']) )
				return FALSE;
 
			extract($options);
			
			$ci->load->config('email');
			
			// carrega configs para email tema
	        $tema_configs = $ci->config->item('email_tema');
	        
	        if( !isset($tema_configs[$tema]) )
	        	return FALSE;
	        $tema_configs = $tema_configs[$tema];
	        
	        // carrega configs de quem vai enviar o email
	        $sender_configs = $ci->config->item('email_sender');
	        
	        // carrega tema
	        $ci->template->set_layout('email');
	        $dados['titulo'] = $tema_configs['titulo'];
	        $html = $ci->template->build('email/'. $tema_configs['template'], $dados, TRUE);
	        $ci->template->set_layout('default');
	 
	        // monta estrutura para envio do email
	        $ci->load->library('email');	        
	        $ci->email->clear();
	        $ci->email->set_newline( "\r\n" );
	        $ci->email->from( $sender_configs['email'], $sender_configs['nome'] );
	        $ci->email->to( $para );
	        $ci->email->subject( $tema_configs['assunto'] );
	        $ci->email->message( utf8_encode($html) );
	        $ci->email->set_alt_message( strip_tags($html) );
 
	        if($ci->email->send())
	        	return TRUE; //echo $ci->email->print_debugger();
	        //else show_error($ci->email->print_debugger());
				
		}
		return FALSE;
	}  
}