<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cidade_model extends MY_Model {
	
	public function __construct() {
		parent::__construct();
		$this->_table = "CEP_CIDADE";
	}
	
	public function get_dropdown() {
		$chave = 'CIDADE_ID';
		$valor = 'CIDADE_DESCRICAO';
		
		return $this->utility_model->get_array_dropdown($this->_table, $chave, $valor); 
	}
	
	public function get_cidade_estado($arr_estado){
		
		$tabela = $this->_table;
		$chave 	= "CIDADE_ID";
		$valor	= "CIDADE_DESCRICAO";
		$order_by = "FLAG_CSO, CIDADE_DESCRICAO";
		
		return $this->utility_model->get_array_dropdown($tabela, $chave, $valor, '',$arr_estado, $order_by); 
		
	}
}
