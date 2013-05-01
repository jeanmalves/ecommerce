<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -----------------------------
| CONFIGURAÇÃO DO ENVIO DE EMAIL
| -----------------------------
*/

/*$config['smtp_host'] 	= 'smtp.makrosis.com.br';
$config['smtp_port'] 	= '587';
$config['smtp_user'] 	= "rafael@makrosis.com.br";
$config['smtp_pass'] 	= "makro3112";*/

$config['protocol']		= 'smtp';
$config['smtp_host'] 	= 'mail.jobdesign.com.br';
$config['smtp_port'] 	= 587;
$config['smtp_user'] 	= "AKIAIVNI3G5P4PBRXBFA";
$config['smtp_pass'] 	= "AgRncfEWVGi9VJ9TzH0R9c5FIlZD/TNkHEf85/nx2l/K";
$config['mailtype'] 	= 'html';
$config['charset'] 		= 'utf-8';
$config['wordwrap'] 	= FALSE;
$config['crlf'] 		= "\r\n";
$config['newline'] 		= "\r\n";

$config['email_sender']['email'] = 'contato@jobdesign.com.br';
$config['email_sender']['nome']  = 'Job Web Design';

/*
| -----------------------------
| CONFIGURAÇÃO DOS TEMAS DOS EMAILS
| -----------------------------
*/

$config['email_tema']['faleconosco']['assunto']		= 'JOb Web Design - Nova mensagem do "Fale Conosco"';
$config['email_tema']['faleconosco']['titulo']		= 'FALE CONOSCO';
$config['email_tema']['faleconosco']['template']	= 'contato';

$config['email_tema']['seleciona_candidato']['assunto']		= 'QUE!!! - Processo Seletivo"';
$config['email_tema']['seleciona_candidato']['titulo']		= 'PROCESSO SELETIVO';
$config['email_tema']['seleciona_candidato']['template']	= 'seleciona_candidato_processo';

$config['email_tema']['candidatar']['assunto']		= 'QUE!!! - Confirmando Candidatura a Vaga';
$config['email_tema']['candidatar']['titulo']		= 'Candidatura Efetuada';
$config['email_tema']['candidatar']['template']		= 'confirma_candidatura';

$config['email_tema']['convidar-processo']['assunto']		= 'QUE!!! - Convite para Processo Seletivo';
$config['email_tema']['convidar-processo']['titulo']		= 'Convite para Processo Seletivo';
$config['email_tema']['convidar-processo']['template']		= 'convida_candidato_processo';

$config['email_tema']['nova-senha']['assunto']				= 'QUE!!! - Esqueci Minha Senha';
$config['email_tema']['nova-senha']['titulo']				= 'Nova Senha de Acesso do Site Que!!';
$config['email_tema']['nova-senha']['template']				= 'nova_senha';

$config['email_tema']['indicar']['assunto']					= 'QUE!!! - Alguém lhe indicou uma vaga';
$config['email_tema']['indicar']['titulo']					= 'Um amigo indicou-lhe uma vaga!!';
$config['email_tema']['indicar']['template']				= 'indicar';

$config['email_tema']['avisa-vencto-convite']['assunto']	= 'QUE!!! - Convite para Processo Seletivo';
$config['email_tema']['avisa-vencto-convite']['titulo']		= 'Lembrete de Processo Seletivo';
$config['email_tema']['avisa-vencto-convite']['template']	= 'avisa_vencto_convite';

$config['email_tema']['expira-em-48hs-prorrog']['assunto']	= 'QUE!!! - Lembrete de vencimento de vaga';
$config['email_tema']['expira-em-48hs-prorrog']['titulo']	= 'Lembrete de vencimento de vaga';
$config['email_tema']['expira-em-48hs-prorrog']['template']	= 'expira_em_48hs_prorrog';

$config['email_tema']['expira-em-48hs']['assunto']			= 'QUE!!! - Lembrete de vencimento de vaga';
$config['email_tema']['expira-em-48hs']['titulo']			= 'Lembrete de vencimento de vaga';
$config['email_tema']['expira-em-48hs']['template']			= 'expira_em_48hs';

$config['email_tema']['expirou-prorrog']['assunto']			= 'QUE!!! - Aviso de encerramento de vaga';
$config['email_tema']['expirou-prorrog']['titulo']			= 'Aviso de encerramento de vaga';
$config['email_tema']['expirou-prorrog']['template']		= 'expirou_prorrog';

$config['email_tema']['expirou']['assunto']					= 'QUE!!! - Aviso de encerramento de vaga';
$config['email_tema']['expirou']['titulo']					= 'Aviso de encerramento de vaga';
$config['email_tema']['expirou']['template']				= 'expirou';

$config['email_tema']['encerra-suspensa']['assunto']		= 'QUE!!! - Aviso de encerramento de vaga';
$config['email_tema']['encerra-suspensa']['titulo']			= 'Aviso de encerramento de vaga';
$config['email_tema']['encerra-suspensa']['template']		= 'encerra_suspensa';

$config['email_tema']['encerra-vaga-byempresa']['assunto']		= 'QUE!!! - Aviso de encerramento de vaga';
$config['email_tema']['encerra-vaga-byempresa']['titulo']			= 'Aviso de encerramento de vaga';
$config['email_tema']['encerra-vaga-byempresa']['template']		= 'encerra_vaga_byempresa';

$config['email_tema']['confirma-senha']['assunto']			= 'QUE!!! - Confirmação de nova senha';
$config['email_tema']['confirma-senha']['titulo']			= 'Sua senha foi alterada com sucesso';
$config['email_tema']['confirma-senha']['template']			= 'confirma_senha';

$config['email_tema']['aviso-candidatura-empresa']['assunto']		= 'QUE!!! - Extrato de Processos';
$config['email_tema']['aviso-candidatura-empresa']['titulo']		= 'Extrato de Processos';
$config['email_tema']['aviso-candidatura-empresa']['template']		= 'aviso_candidatura_empresa';

$config['email_tema']['aviso-encerramento-candidato']['assunto']	= 'QUE!!! - Aviso de encerramento de vaga';
$config['email_tema']['aviso-encerramento-candidato']['titulo']		= 'Aviso de encerramento de vaga';
$config['email_tema']['aviso-encerramento-candidato']['template']	= 'aviso_encerramento_candidato';

$config['email_tema']['avisa-cadastro-empresa-usuario']['assunto']	= 'Aviso de cadastro de empresa e usuário';
$config['email_tema']['avisa-cadastro-empresa-usuario']['titulo']	= 'Nova empresa e usuário cadastrados no site';
$config['email_tema']['avisa-cadastro-empresa-usuario']['template']	= 'aviso_cadastro_empresa_usuario';

$config['email_tema']['avisa-cadastro-usuario']['assunto']			= 'Aviso de cadastro de usuário';
$config['email_tema']['avisa-cadastro-usuario']['titulo']			= 'Novo usuário cadastrado no site';
$config['email_tema']['avisa-cadastro-usuario']['template']			= 'aviso_cadastro_usuario';

$config['email_tema']['avisa-cadastro-vaga']['assunto']				= 'Aviso de cadastro de Vaga';
$config['email_tema']['avisa-cadastro-vaga']['titulo']				= 'Nova vaga cadastrada no site';
$config['email_tema']['avisa-cadastro-vaga']['template']			= 'aviso_cadastro_vaga';

$config['email_tema']['email-aniversariante']['assunto']			= 'Hoje é seu dia!';
$config['email_tema']['email-aniversariante']['titulo']				= 'Feliz Aniversário';
$config['email_tema']['email-aniversariante']['template']			= 'email_aniversario';

$config['email_tema']['contactar-candidato']['assunto']				= 'Contato de empresa';
$config['email_tema']['contactar-candidato']['titulo']				= 'QUE!!! - Você recebeu uma mensagem';
$config['email_tema']['contactar-candidato']['template']			= 'contactar_candidato';