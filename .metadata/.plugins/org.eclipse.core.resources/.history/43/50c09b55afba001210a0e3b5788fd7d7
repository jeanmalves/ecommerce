<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto_model extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = "Produto";
	}

	public function cadastrarProduto($descricao, $status, $imagem){
		$data = array(
			'descricao' => $descricao;
			'status' => $status;
			'imagem' => $imagem;
			);

		$this->db->insert_batch($data);
	}
}
