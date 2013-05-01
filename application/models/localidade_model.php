<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Localidade_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_table = "CEP_ENDERECO";
	}	
	
	public function get_endereco($cep) {
		
		$cep = preg_replace("([.-])", "", $cep);
		
		$this->db->select('IF(E.ENDERECO_CEP IS NULL,C.CIDADE_CEP,E.ENDERECO_CEP) AS CEP', FALSE);
		$this->db->select('CONCAT(E.ENDERECO_TIPOLOGR," ",E.ENDERECO_LOGR) AS ENDERECO', FALSE);
		$this->db->select(' B.BAIRRO_DESCRICAO AS BAIRRO, 
							C.CIDADE_ID, C.CIDADE_DESCRICAO AS CIDADE,
						  	UF.UF_SIGLA, UF.UF_DESCRICAO AS UF');
		
		$this->db->from('CEP_ENDERECO AS E');
			
		$this->db->join('CEP_BAIRRO AS B','E.BAIRRO_ID = B.BAIRRO_ID', 'LEFT OUTER');
		$this->db->join('CEP_CIDADE AS C','B.CIDADE_ID = C.CIDADE_ID', 'LEFT OUTER');
		$this->db->join('CEP_UF AS UF','UF.UF_ID = C.UF_ID', 'LEFT OUTER');
		
		$this->db->where('E.ENDERECO_CEP', $cep);
		$this->db->or_where('C.CIDADE_CEP', $cep);
		   
		$q = $this->db->get();
   		if( $q->num_rows() == 1 )
   		{
   			return $q->row_array();
	    }
		else
   		{
   	   		return false;
   		}	
	}
	public function get_cidade($cep) {
		
		$cep = preg_replace("([.-])", "", $cep);
		
		$this->db->select('E.CIDADE_CEP AS CEP', FALSE);
		$this->db->select('E.CIDADE_ID AS CIDADE,
						   E.CIDADE_DESCRICAO AS ENDERECO,	
						  	UF.UF_SIGLA AS UF');
		
		$this->db->from('CEP_CIDADE AS E');
		$this->db->join('CEP_UF AS UF','UF.UF_ID = E.UF_ID', 'LEFT OUTER');
		
		$this->db->where('E.CIDADE_CEP', $cep);
		   
		$q = $this->db->get();
   		if( $q->num_rows() == 1 )
   		{
   			return $q->row_array();
	    }
		else
   		{
   	   		return false;
   		}	
	}
	
}
