<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fornecedor_model extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = "fornecedores"; // carrega a tabela fornecedores
	}
}
