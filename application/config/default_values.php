<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -----------------------------
| VALORES DEFAULT PARA ARRAYS
| -----------------------------
*/

$config['array']['default_dropdown'] 	= array( '' => 'Selecione..' );
$config['array']['default_todos'] 		= array( '' => 'TODOS..' );
$config['array']['sexo'] 				= array( 'M' => 'Masculino', 'F' => 'Feminino');
$config['array']['opcao_sexo'] 			= array( 'I' => 'INDIFERENTE', 'M' => 'MASCULINO', 'F' => 'FEMININO');
$config['array']['inscricao'] 			= array( 'I' => 'ISENTO', 'M' => 'MUNICIPAL', 'E' => 'ESTADUAL');
$config['array']['nivel_escolar']		= array( '1' => 'ENSINO FUNDAMENTAL', '3' => 'ENSINO M�DIO', '5' => 'P�S-M�DIO (T�CNICO)', '7' => 'ENSINO SUPERIOR', '9' => 'P�S GRADUA��O', '11' => 'MESTRADO', '13' => 'DOUTORADO' );
$config['array']['situacao_escolar']	= array( '1' => 'CURSANDO', '2' => 'INTERROMPIDO', '3' => 'COMPLETO' );	
$config['array']['nivel_idioma']		= array( '1' => 'B�SICO', '2' => 'INTERMEDI�RIO', '3' => 'AVAN�ADO', '4' => "FLUENTE" );
$config['array']['nivel_hierarquico']   = array( '1' => 'DIRETORIA', '2' => 'GER�NCIA', '13' => 'COORDENADOR', '3' => 'ENCARREGADO/SUPERVISOR', '4' => 'ANALISTA/T�CNICO COM N�VEL SUPERIOR', '5' => 'T�CNICO N�VEL M�DIO', '6' => 'OPERACIONAL (PRODU��O/ADMINISTRA��O)', '7' => 'TRAINEE', '8' => 'ESTAGI�RIO' );
$config['array']['sim_nao'] 			= array( 'N' => "N�O", 'S' => "SIM" );
$config['array']['opcao_sim_nao_indif']	= array( 'I' => 'INDIFERENTE', 'N' => 'N�O', 'S' => 'SIM' );
$config['array']['relacao_emprego']		= array( '1' => 'CTPS', '2' => 'AUT�NOMO', '3' => 'EMPRES�RIO', '4' => 'ESTAGI�RIO', '5' => 'TEMPOR�RIO', '6' => 'PRESTADOR DE SERVI�OS', '7' => 'CONSULTOR AUT�NOMO', '8' => 'FREE LANCER', '9' => 'OUTRO' );
$config['array']['disp_horario']		= array( '1' => 'TOTAL', '2' => 'COMERCIAL (2A. A SEXTA)', '3' => 'COMERCIAL (2A. A S�BADO)', '4' => 'MANH�', '5' => 'TARDE', '6' => 'NOITE', '7' => 'TURNOS DE REVEZAMENTO' );
$config['array']['deficiencia'] 		= array( '1' => 'VISUAL', '2' => 'CADEIRANTE', '3' => 'MEMBROS INFERIORES', '4' => 'MEMBROS SUPERIORES', '5' => 'AUDITIVA', '6' => 'OUTRA' );
$config['array']['beneficios']			= array( '1' => 'Vale Transporte', '2' => 'Vale Refei��o', '3' => 'Vale Alimenta��o', '4' => 'Refei��o no Local', '5' => 'Cesta B�sica', '6' => 'Ajuda de Custo', '7' => 'Aux�lio Creche', '8' => 'Conv�nio Farm�cia', '9' => 'P.L.R.', '10' => 'Telefone Celular', '11' => 'Bolsa de Estudos', '12' => 'Assist�ncia M�dica', '13' => 'Assist. Odontol�gica');
$config['array']['opcao_est_civil']		= array( 'I' => 'INDIFERENTE', 'C' => 'CASADO', 'S' => 'SOLTEIRO'); 
$config['array']['opcao_est_civil_cand']= array( '1' => 'CASADO', '2' => 'DESQUITADO', '3' => 'DIVORCIADO', '4' => 'SEPARADO', '5' => 'SOLTEIRO', '6' => 'VI�VO', '7' => 'UNI�O EST�VEL');
$config['array']['opcao_filhos']		= array( 'I' => 'INDIFERENTE', 'N' => "N�O", 'S' => "SIM", 'M' => 'MAIORES DE 10 ANOS' );
$config['array']['experiencia']			= array( 'I' => 'INDIFERENTE', '1' => '00 A 03 MESES', '2' => '03 A 06 MESES', '3' => '06 A 09 MESES', '4' => '09 A 12 MESES', '5' =>  '12 A 18 MESES', '6' =>  '18 A 24 MESES', '7' =>  '24 A 36 MESES', '8' =>  '36 A 48 MESES', '9' =>  '48 A 60 MESES', '10' =>  'ACIMA DE 60 MESES' );
$config['array']['vaga_status']			= array( '1' => 'Publicada', '2' => 'Suspensa', '3' => 'Encerrada Parcial', '4' => 'Encerrada Total', '9' => 'Cancelada' );
$config['array']['processo_status']		= array( '1' => 'Aprovado', '2' => 'Selecionado', '3' => 'Inscrito', '4' => 'Reprovado', '5' => 'Convidado' );
$config['array']['faixa_salarial']		= array( '1' => 'De 500 at� 1.000', '2' => 'De 1.001 at� 1.500', '3' => 'De 1.501 at� 2.000', '4' => 'De 2.001 at� 3.000', '5' => 'De 3.001 at� 4.000', '6' => 'De 4.001 at� 6.000', '7' => 'De 6.001 at� 8.000', '8' => 'De 8.001 at� 10.000', '9' => 'Acima de 10.000');
$config['array']['filtro_alerta_que']	= array( '1' => 'Sexo', '2' => 'P.C.D.(Pessoas Com Defici�ncia)', '3' => '�rea Profissional', '4' => 'Cargo', '5' => 'Escolaridade', '6' => 'Estado', '7' => 'Cidade');
$config['array']['cnh_cat']				= array( 'N' => 'NENHUM', 'A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D', 'E'=>'E', 'AB'=>'AB', 'AC'=>'AC', 'AD'=>'AD', 'AE'=>'AE');		
$config['array']['veiculo']				= array( '1' => 'CARRO', '2'=>'MOTO', '3'=>'CARRO E MOTO', '98'=>'N�O TENHO'	);	
$config['array']['planos']				= array( '1' => 'Basic', '2'=>'Standard', '3'=>'Advanced');
/*
| -------------------------------------------------------------------
| VALORES DEFAULT PARA MENSAGENS
| -------------------------------------------------------------------
*/

$config['mensagem']['inclusao_sucesso']	= 'Registro inclu�do com sucesso.';
$config['mensagem']['inclusao_erro']	= 'Houve um erro ao tentar incluir o registro. Por favor, tente novamente mais tarde.';
$config['mensagem']['edicao_sucesso']	= 'Registro alterado com sucesso.';
$config['mensagem']['edicao_erro']		= 'Houve um erro ao tentar alterar o registro. Por favor, tente novamente mais tarde.';
$config['mensagem']['remocao_sucesso']	= 'Registro removido com sucesso.';
$config['mensagem']['remocao_erro']		= 'Houve um erro ao tentar remover o registro. Por favor, tente novamente mais tarde.';
$config['mensagem']['invalido'] 		= 'Por favor, verifique os campos marcados em vermelho.';

/*
| -------------------------------------------------------------------
| PREPOSI��ES PARA SEREM UTILIZADAS NA DESCRI��O DA BUSCA
| -------------------------------------------------------------------
*/

$config['preposicao']['AC'] = 'no'; // ACRE
$config['preposicao']['AL'] = 'em'; // ALAGOAS
$config['preposicao']['AP'] = 'no'; // AMAP�
$config['preposicao']['AM'] = 'no'; // AMAZONAS
$config['preposicao']['BA'] = 'na'; // BAHIA
$config['preposicao']['CE'] = 'no'; // CEAR�
$config['preposicao']['DF'] = 'no'; // DISTRITO FEDERAL
$config['preposicao']['ES'] = 'no'; // ESP�RITO SANTO
$config['preposicao']['RR'] = 'em'; // RORAIMA
$config['preposicao']['GO'] = 'em'; // GOI�S
$config['preposicao']['MA'] = 'no'; // MARANH�O
$config['preposicao']['MT'] = 'no'; // MATO GROSSO
$config['preposicao']['MS'] = 'no'; // MATO GROSSO DO SUL
$config['preposicao']['MG'] = 'em'; // MINAS GERAIS
$config['preposicao']['PA'] = 'no'; // PAR�
$config['preposicao']['PB'] = 'na'; // PARA�BA
$config['preposicao']['PR'] = 'no'; // PARAN�
$config['preposicao']['PE'] = 'em'; // PERNAMBUCO
$config['preposicao']['PI'] = 'no'; // PIAU�
$config['preposicao']['RJ'] = 'no'; // RIO DE JANEIRO
$config['preposicao']['RN'] = 'no'; // RIO GRANDE DO NORTE
$config['preposicao']['RS'] = 'no'; // RIO GRANDE DO SUL
$config['preposicao']['RO'] = 'em'; // ROND�NIA
$config['preposicao']['TO'] = 'em'; // TOCANTINS
$config['preposicao']['SC'] = 'em'; // SANTA CATARINA
$config['preposicao']['SP'] = 'em'; // S�O PAULO
$config['preposicao']['SE'] = 'em'; // SERGIPE
