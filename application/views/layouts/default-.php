<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> - <?php echo $title; ?></title>

<script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/plugins/accordionmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/plugins/jquery.orbit-1.2.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/plugins/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/plugins/jquery.maskedinput.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/plugins/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/plugins/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/plugins/jquery.mkscommon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>static/js/script_jquey.js"></script>

<link href="<?php echo base_url(); ?>static/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>static/css/accordionmenu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>static/css/fontes/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>static/css/skin.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>static/css/orbit-1.2.3.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	var system_vars = new Object();
	system_vars.base_url = '<?php echo base_url(); ?>';
</script>
</head>

<body>
<div id="sombra">
    <div id="container">
        <div id="topo">
            <div id="container-conteudo-topo">
            	<div class="logo"></div>
            	<div class="login"><a href="<?php echo base_url(); ?>/login">Faça login </a>ou<a href="<?php echo base_url(); ?>"> Cadastre-se</a></div>
                <div id="carrinho-compras">
                	<div>Meu Carrinho</div>
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url();?>static/img/carrinho-compras.png" /></a></div>
            </div>    
         	<div id="menubar">
                     <ul>
                        <li><a href="#undefined" title="Página Inicial">Página Inicial</a></li>
                        <li><a href="#undefined" title="Sobre">Sobre</a></li>
                        <li><a href="#undefined" title="Contactos">Produtos</a></li>
                        <li><a href="#undefined" title="Negócios" class="selecionado">Contato</a></li>
                        <li><a href="#undefined" title="Suporte">SAC</a></li>
                  </ul>
                </div><!-- end menubar -->
                <div id="linhaAmarela"></div>
                <div id="linhaVermelha"></div>
            </div><!-- end topo -->
            <div id="slider">
                <img src="<?php echo base_url(); ?>static/img/banners/compras.jpg" width="1000" height="350" alt="compras" />
                <div id="linhaVermelha"></div>
            </div><!-- end slider -->
            
            <div id="breadcrumb"><?php echo $this->breadcrumb->output(); ?></div>
			
            <div id="conteudo">
       			<?php echo $template['body']; ?>
       		</div>
            <div id="footer">
        	<div id="linhaVermelha"></div>
        	<div id="menu-footer"></div>
            <div id="container-copy">
                <div id="copy">
                    &copy; E-commerce. Todos os direitos reservados.
                </div><!-- end copy -->
                <div id="logo-footer"><img src="<?php echo base_url(); ?>static/img/logo-footer.png" width="90" height="38" /></div>
            </div>    
        </div><!-- end footer -->   
    </div><!-- end container -->   
</div><!-- end sombra -->
</body>
</html>