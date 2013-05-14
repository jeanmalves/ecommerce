<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estoque_model extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = "estoque";
	}
	
	public function getProdutoEstoque($paginacao=false, $totalcount=false)
	{
	// retorna count se for apenas consulta de totalcount
		if( $totalcount ) {
			return $this->db->count_all_results();
		}
		
		if( $paginacao && is_array($paginacao) ) {
			$this->db->limit($paginacao['limit'], $paginacao['offset']);
		}
		//busca os registros no banco atraves do join, vai trazer alem dos campos do estoque, tambem o nome do produto.
		$this->db->select('p.nome, e.estoqueMinimo, e.quantidade, e.preco');
		 $this->db->from($this->_table. ' as e');
		$this->db->join('produto as p','p.idProduto = e.idProduto','inner');
		$this->db->group_by('e.idProduto');
		$produtos = $this->db->get($this->_table);
		
		if( $produtos->num_rows() != 0 ){
			$resultado = $produtos->result_array();
			$soma = 0;
			foreach ($resultado as $chv => $valor){
					$resultado[$chv] = "<tr>
											<td>".$valor['nome']."</td>
											  <td>".$valor['estoqueMinimo']." </td>
											  <td>".$valor['quantidade']." </td>
											  <td>".$valor['preco']." </td>
											  <td><i class='icon-wrench'></i></td>
											  <td><i class='icon-remove'></i></td>	
										 </tr>";
					$soma += $valor['preco'];
				}
				$resultado['total'] = $soma;
		
			return $resultado;	
		}
		return ($totalcount) ? 0 : FALSE;
	}
	public function getProdutoComEstoque($paginacao=false, $totalcount=false)
	{
	// retorna count se for apenas consulta de totalcount
		if( $totalcount ) {
			return $this->db->count_all_results();
		}
		
		if( $paginacao && is_array($paginacao) ) {
			$this->db->limit($paginacao['limit'], $paginacao['offset']);
		}
		//busca os registros no banco atraves do join, vai trazer alem dos campos do estoque, tambem o nome do produto.
		$this->db->select('p.nome, p.descricao, e.quantidade, e.preco');
		$this->db->from($this->_table. ' as e');
		$this->db->join('produto as p','p.idProduto = e.idProduto','inner');
		$this->db->group_by('e.idProduto');
		$this->db->where('p.status = "Ativo" AND e.quantidade > 0');
		$produtos = $this->db->get($this->_table);
		
		if( $produtos->num_rows() != 0 ){
			$resultado = $produtos->result_array();
			$soma = 0;
			foreach ($resultado as $chv => $valor){
				//config. span3 style='margin-left:5px;margin-right:5px;'.
					$resultado[$chv] = "
									<li class='span3'>
										<div class='thumbnail'>
											<img alt='260x180' data-src='holder.js/260x180' style='width: 260px; height: 180px;' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQQAAAC0CAYAAABytVLLAAAD3UlEQVR4nO3aMW7bShRA0ex/Ke7UqVGnTqV6LYFb8K/mhqZGjIN8wBRwilMknpB0gHdBDvlrWZZPgGVZPn/99AUAxyEIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAQBiCAAEQQgggBEEIAIAhBBACIIQAThgC6Xy+fHx0eu1+vTmtvt9mXN7XZ7WnM+n/v56XT6p2t6PB4vj3O/379cy2zN+Pd7vxM/TxAOZj3Erwboer1O19zv993j/EsUTqfT9BjbGMzOtY2BKByXIBzIerjGcK+Hf6wbf348Hp/L8nv4L5fL03HGmr07ie9e0ywI425m/P3sdxhrzufz57J8vbv56f9zvhKEAxmDsh669YCt14zhmhkRWa8ZQzmiMSKyPte4C5iFZbZ+dtxlWZ6CMI67jtHsroafJwgHt43EGPbtY8N6sGZDuo3E+jb+drtN70RGEGbXsT3u7A5hrJld4ywS/DxBOLD10I7n7Vf7B7Nb9L0gvDrWqwF9FYT1+V4FShDehyAc2Oy5fT3E2z2EMezfDcKy/B7MPz2G7AVhFqe9R4j1eQXhWAThgLa78uufzQZ7O6x/E4R1YPaG81UQthuay/K8gSkI70MQDmjvNeFsU/HVPsPepuKyzF8HvrqmV0GYDfaIxHjMsan4PgThYNbfD8x+vh7iV6/1vvvacf2osX3DsPWnIMzuEEYQvHZ8H4JwINuvD7fGcP8fHyatz/V4PKbfD8yubRuEvWsea3yY9D4E4UBmu/WzICzLcxRmQ7z36fJsKNfn3x5rb1Nx9rXido1Pl9+DIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCEEEAIghABAGIIAARBCCCAEQQgAgCkP8AVFP6VIBhhegAAAAASUVORK5CYII='>
											<div class='caption'>
                   								 <h3>".$valor['nome']."</h3>
												 <p>".$valor['descricao']."</p>
											  	 <p>".$valor['preco']." </p>
												 <p><a class='btn btn-primary' href='#'>Comprar</a></p>
											  </div>
										 </div>
									</li>	 
										";
				}
		
			return $resultado;	
		}
		return ($totalcount) ? 0 : FALSE;
	}
}
