<!DOCTYPE html>
	<html lang="en">
		<meta charset="UTF-8">
		<head>
	    	<title><?php echo $template['title']?></title>
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    	<!-- Bootstrap -->
	    	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	    	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="screen">
	    	
	    </head>
	    <body>
	    	<div class="container">
	    		<?php echo (isset($template['partials']['header']))?$template['partials']['header'] : ''; ?>	
	    		<br /> 
	    		<?php echo (isset($template['partials']['menu']))?$template['partials']['menu'] : ''; ?>
	    	    <?php echo (isset($template['partials']['slideshow']))?$template['partials']['slideshow'] : ''; ?>
			    <ul class="breadcrumb">
			    	<?php echo $this->breadcrumb->output(); ?>
				   <!-- <li><a href="#">Home</a> <span class="divider">/</span></li>
				    <li><a href="#">Library</a> <span class="divider">/</span></li>
				    <li class="active">Data</li>-->
    			</ul>
    			<?php echo(isset($template['partials']['sidebar']))? $template['partials']['sidebar'] : ''; ?>
	    		<!-- <div class="conteudo"> -->
		    		<!-- <div class="well">-->
		    			<?php echo $template['body']; ?>
		    		<!-- </div>-->
		    	<!-- </div> -->
	    		<footer>
        			<div id="menu-footer"></div>
	                <p class="text-center">&copy; E-commerce. Todos os direitos reservados.</p>
	    		</footer>
	   			<script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
		    	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		    	<script src="<?php echo base_url(); ?>assets/js/bootstrap-carousel.js"></script>
		    	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
		    	<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
		    	<script>
			    	$('.carousel').carousel({
			    	  interval: 3000
			    	})
	    		</script>
	    	</div>	
	    </body>
    </html>