<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * My Form Validation Class extended
 *
 * @category	Validation
 * @author		Rafael Dantas
 */
class MY_Form_validation extends CI_Form_validation {
	
	public function __construct($rules = array()) {
		parent::__construct($rules);
		
		// change error delimiters
		$this->_error_prefix = '<span class="error">';
        $this->_error_suffix = '</span>';
	}
	
	/**
	 * Valid CPF
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function valid_cpf($str) {
		$ci =& get_instance();
		$this->set_message('valid_cpf', 'CPF inválido!');

		$nulos = array("12345678909","11111111111","22222222222","33333333333",
               "44444444444","55555555555","66666666666","77777777777",
               "88888888888","99999999999","00000000000");
		
		// Retira todos os caracteres que não sejam 0-9
		$cpf = preg_replace("/[^0-9]/", "", $str);
		
		// Inválido, se tamanho diferente de 11
		if( strlen($cpf) != 11 )
			return FALSE;
		
		// Inválido, se houver letras no cpf
		if( preg_match("/[^0-9]/", $cpf) == 1 )
		    return FALSE; 
		   
		// Inválido, se vazio
		if( in_array($cpf, $nulos) )
		    return FALSE;
		
		// Calcula o penúltimo dígito verificador
		$acum=0;
		for( $i=0; $i<9; $i++ ) {
		  $acum+= $cpf[$i]*(10-$i);
		}
		
		$x=$acum % 11;
		$acum = ($x>1) ? (11 - $x) : 0;
		
		// Inválido, se o digito calculado for diferente do passado na string
		if( $acum != $cpf[9] ){
		  return FALSE;
		}
		
		// Calcula o último dígito verificador
		$acum=0;
		for( $i=0; $i<10; $i++ ){
		  $acum+= $cpf[$i]*(11-$i);
		}  
		
		$x=$acum % 11;
		$acum = ($x > 1) ? (11-$x) : 0;
		
		// Inválido, se o digito calculado for diferente do passado na string
		if( $acum != $cpf[10] ){
		  return FALSE;
		}  
		
		return TRUE;
	}
	
}