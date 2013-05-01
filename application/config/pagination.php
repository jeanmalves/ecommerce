<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| ------------------------------------
| CONFIGURA��O DA CLASSE DE PAGINA��O
| ------------------------------------
*/

$config['base_url'] 		= base_url().'cities';
$config['uri_segment']  	= 1;
$config['full_tag_open'] 	= '<div class="pagination">';
$config['full_tag_close'] 	= '</div>';
$config['cur_tag_open'] 	= '<span class="current">';
$config['cur_tag_close'] 	= '</span>';
$config['use_page_numbers'] = TRUE; 