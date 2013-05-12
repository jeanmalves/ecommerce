<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 					   = "home";
$route['area-cliente/login']					   = "login";	
$route['area-cliente/logout']					   = "login/sair";
$route['admin']		 		 					   = "admin/home";
$route['admin/login']		 		 			   = "admin/login";	
$route['login/loja']			 		 		   = "login/autenticaUsuario";
$route['admin/produto']			 		 		   = "produto";


$route['servicos/hospedagem']					   = "hospedagem"; 
$route['hospedagem/assinar-plano']				   = "pedido"; 	
$route['hospedagem/assinar-plano/(:any)']		   = "pedido"; 
$route['hospedagem/pagamento']					   = "central_pagamento";	
$route['contato/envia-mensagem']				   = "contato/envia";	  	

$route['getPreco']								   = "ajax/getPrecoPlano";	
$route['cep']					   				   = "ajax/busca_cep";
$route['validaCep']								   = "ajax/valida_cep";
$route['checkCpf']								   = "ajax/check_cpf";
$route['checkCnpj']								   = "ajax/check_cnpj";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */