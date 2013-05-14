<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto_model extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = "produto";
	}
	
	public function getProdutos($paginacao=false, $totalcount=false)
	{
		// retorna count se for apenas consulta de totalcount
		if( $totalcount ) {
			return $this->db->count_all_results();
		}
		
		if( $paginacao && is_array($paginacao) ) {
			$this->db->limit($paginacao['limit'], $paginacao['offset']);
		}
		//busca os registros no banco atraves do join, vai trazer alem dos campos do estoque, tambem o nome do produto.
		$this->db->select('nome, descricao, status');

		$produtos = $this->db->get($this->_table);
		
		if( $produtos->num_rows() != 0 ){
			$resultado = $produtos->result_array();
			$soma = 0;
			foreach ($resultado as $chv => $valor){
			
					$resultado[$chv] = "<tr>
											<td>".$valor['nome']."</td>
											  <td>".$valor['descricao']." </td>
											  <td>". $valor['status']. " </td>
											  <td><i class='icon-wrench'></i></td>
											  <td><i class='icon-remove'></i></td>	
										 </tr>";
				}
		
			return $resultado;	
		}
		return ($totalcount) ? 0 : FALSE;
	}
	
	//Tras os registros dos produtos para carregar num select na view.
	public function getProdutoDropdown()
	{
		$tabela = $this->_table;
		$chave  = "idProduto";
		$valor  = "nome";

		return $this->utility_model->get_array_dropdown($tabela, $chave, $valor);
	}
}
