<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto_model extends MY_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function cadastrarProduto($descricao, $status, $imagem, $idFornecedor){
		$this->_table = "Produto";
		$data = array( // cria o array de dados
			'descricao' => $descricao;
			'status' => $status;
			'imagem' => $imagem;
			);

		$this->db->insert_batch($data); // insere na tabela

		$this->db->select('idProduto'); // seleciona o id criado pelo AI
		$this->db->where('descricao', $descricao);
		$this->db->where('imagem', $imagem);
		$this->db->where('status', $status);
		
		$query = $this->db->get();
		
		$idProduto = $query->result()->idProduto; // aqui eu tive dúvida, é assim mesmo?
		
		cadastrarProdutoFornecedor($idProduto, $idFornecedor); // insere na tabela ProdutoFornecedor
	}

	private function cadastrarProdutoFornecedor($idProduto, $idFornecedor){
		$this->_table = "ProdutoFornecedor";
		$data = array( // cria o array de dados
			'idProduto' => $idProduto;
			'idFornecedor' => $idFornecedor;
			);

		$this->db->insert_batch($data); // insere os dados na tabela ProdutoFornecedor
	}
}
