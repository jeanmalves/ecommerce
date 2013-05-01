<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility_model extends CI_Model {
	
	/**
	 * Get Array DropDown
	 * -----------------------------------
	 * Retorna um array de resultados para 
	 * ser incluído em algum menu dropdown
	 * -----------------------------------
	 * @access	public
	 * @param   $tabela, $chave, $label, $opcao_default='Selecione..'
	 * @return	array
	 * @author  Rafael Dantas
	 */
	public function get_array_dropdown($tabela, $chave, $label, $opcao_default='Selecione..') {
		
		$q = $this->db->get($tabela);
		$retorno = $q->result_array();
		
		if( $retorno ) {
			if( $opcao_default != '' ) $array[''] = $opcao_default;
			foreach( $retorno as $assunto )
				$array[$assunto[$chave]] = $assunto[$label];
		} else
			$array[''] = 'Nenhum resultado';
		
		return $array;
	}
	
	public function get_nivel_hierarquico_dropdown()
	{
		$tabela = "TB_NIVEL_HIERARQUIA";
		$chave 	= "NVH_ID";
		$valor	= "NVH_NOME";
		$optdefault = 'Selecione...';
		
		return $this->utility_model->get_array_dropdown($tabela, $chave, $valor, $optdefault); 
	}

	public function get_cargo_dropdown()
	{
		$tabela = "TB_CARGO";
		$chave 	= "CRG_ID";
		$valor	= "CRG_NOME";
		$optdefault = 'Selecione um cargo...';
		
		return $this->utility_model->get_array_dropdown($tabela, $chave, $valor, $optdefault); 
	}
	
}