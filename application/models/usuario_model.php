<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends MY_Model {
	
	public function __construct() {
		parent::__construct();
		$this->_table = "tb_usuario";
	}
	
	public function autenticaLogin( $usuario, $senha ) {
		$this->db->select('usr_id, usr_nome, usr_login');
		$this->db->where('usr_login', $usuario);
		$this->db->where('usr_senha', $senha);
		$q = $this->db->get($this->_table);

		if( $q->num_rows() == 1 )
			return $q->row_array();
		return FALSE;
	}	
	
}