<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * My Model Class extended
 *
 * @category	Model
 * @author		Rafael Dantas
 */
class MY_Model extends CI_Model {
	
	protected $_table = NULL;
	
	/**
	 * Funções CRUD
	 */
	
	public function insert($data = array()) {
		if( $this->_table != NULL ) {
			
			// verifica valor vazio e tira do array de inserção
			foreach( $data as $k => $v )
				if( $v == null ) unset($data[$k]);
			
			$this->db->insert( $this->_table, $data );
			return $this->db->insert_id();
		}
		return FALSE;
	}
	
	public function get( $param = array() ) {
		
		// define values
		$fields 	= isset($param['fields']) 	? $param['fields']   	: '*';
		$where  	= isset($param['where']) 	? $param['where']   	: '';
		$ordering 	= isset($param['ordering'])	? $param['ordering']	: '';
		$offset 	= isset($param['offset']) 	? $param['offset']   	: '';
		$limit 		= isset($param['limit']) 	? $param['limit'] 	  	: '';
		
		if( $this->_table != NULL ) {
			
			// select fields
			$this->db->select($fields);
			
			// conditions
			if( $where != NULL )
				$this->db->where($where);
				
			// ordering
			if( $ordering != NULL )
				$this->db->order_by($ordering);
			
			// limit and offset
			if( $limit != NULL && is_numeric($limit) ) {
				if( $offset == NULL || !is_numeric($offset) )
					$this->db->limit($limit);
				else		
					$this->db->limit($limit, $offset);
			}
			
			// execute query
			$q = $this->db->get($this->_table);
			
			// return result
			if( $q->num_rows() > 0 )
				return $q->result_array();		
		}
		return FALSE;
	}
	
	public function update($dados = array(), $where) {
		// varre array para trocar valor vazio para null
		foreach( $dados as $k=>$v ):
			if( $v == '' ) $dados[$k] = NULL;
		endforeach;
		$this->db->update( $this->_table, $dados, $where );
		return TRUE;
	}
	
	public function delete($where) {
		$this->db->where($where)->delete($this->_table);
		return TRUE;
	}
	
	/**
	 * Demais funções genéricas públicas
	 */
	
	/**
	 * Get One
	 * ----------------------------------------------
	 * Retorna UM registro com todos os campos de uma 
	 * determinada tabela a partir da sua chave $id
	 */
	public function get_one($id) {
		return $this->db->where('id', $id)->get($this->_table)->row_array();
	}
	
	/**
	 * Get More By
	 * ----------------------------------------------
	 * Retorna VÁRIOS registro com todos os campos de uma 
	 * determinada tabela a partir da sua chave $id e o campo
	 * que quer ser comparado
	 */
	public function get_more_by($field = '', $value = '', $limit=false) {
		if( $field == '' || $value == '' ) return FALSE;
		$this->db->where($field, $value);
		if( $limit ) $this->db->limit($limit);
		$q = $this->db->get($this->_table);		
		return ($q->num_rows() > 0) ? $q->result_array() : FALSE;
	}
	
	/**
	 * Get One By
	 * ------------------------------
	 * Semelhante ao Get One, porém nesta função é
	 * possível escolher o campo que será a chave
	 * de comparação
	 */
	public function get_one_by($field = '', $value = '') {
		if( $field == '' || $value == '' ) return FALSE;
		$q = $this->db->where($field, $value)->get($this->_table);		
		return ($q->num_rows() > 0) ? $q->row_array() : FALSE;
	}
	
	/**
	 * Get One Field By
	 * ------------------------------
	 * Retorna o valor de apenas um campo.
	 * É possível escolher o campo a ser retornado e 
	 * o campo que será a chave de comparação
	 */
	public function get_one_field_by($field_return = '', $field_compar = '', $value = '') {
		if( $field_return != '' && $field_compar != '' && $value != '' ) {
			$result = $this->db
						->select($field_return)
						->where($field_compar, $value)
						->get($this->_table)
						->row_array();
			return $result[$field_return];
		}		
		return FALSE;
	}
	
	/**
	 * Exists
	 * ----------------------------
	 * Verifica se existe um registro
	 */
	public function exists($value, $field='') {
		if( $field == '' ) return FALSE;
		return ($this->get_one_by($field, $value) === FALSE) ? FALSE : TRUE;
	}
	
}