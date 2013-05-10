<!DOCTYPE html>
	<html lang="en">
		<meta charset="UTF-8">
		<head>
	    	<title>Bootstrap 101 Template</title>
	    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    	<!-- Bootstrap -->
	    	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	    	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="screen">
	    	
	    </head>
	    <body>
	    	<div class="container">
	    		<header class="jumbotron subhead">
	    			 <div class="container">
	    			 	<div class="carbonad">
	    			 		<img alt="" src="<?php echo base_url(); ?>assets/img/logo.png" />
	    			 	</div>
	    			 	<div class="login">
	    			 		<p> <a href>Acesse sua área</a> ou <a href>cadastre-se</a> </p>
	    			 	</div>	
	    			 	<div id="carrinho-container">
	    			 		<img alt="" src="<?php echo base_url(); ?>assets/img/carrinho-compras.png" />
	    			 		<h6>Carrinho vazio.</h6>
	    			 	</div>
	    			 </div>
	    		</header>	
	    		<br /> 
	    		<div class="navbar navbar-inverse">
			      <div class="navbar-inner">
			        <div class="container">
			          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			          </button>
			          <a href="./index.html" class="brand">Bootstrap</a>
			          <div class="nav-collapse collapse">
			            <ul class="nav">
			              <li class="">
			                <a href="./index.html">Home</a>
			              </li>
			              <li class="">
			                <a href="./getting-started.html">Get started</a>
			              </li>
			              <li class="">
			                <a href="./scaffolding.html">Scaffolding</a>
			              </li>
			              <li class="">
			                <a href="./base-css.html">Base CSS</a>
			              </li>
			              <li class="">
			                <a href="./components.html">Components</a>
			              </li>
			              <li class="active">
			                <form class="navbar-search pull-left" action="">
								<input class="search-query span2" type="text" placeholder="Search">
							</form>
			              </li>
			            </ul>
			          </div>
			        </div>
			      </div>
			    </div>
	    	    <div id="myCarousel" class="carousel slide">
				    <ol class="carousel-indicators">
					    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					    <li data-target="#myCarousel" data-slide-to="1"></li>
					    <li data-target="#myCarousel" data-slide-to="2"></li>
				    </ol>
				    <!-- Carousel items -->
				    <div class="carousel-inner">
				    <div class="active item">
				    	<img src="<?php echo base_url(); ?>assets/img/compras.jpg" alt="">
				    	<div class="carousel-caption">
	                    </div>
				    </div>
				    <div class="item">
				    	<img src="<?php echo base_url(); ?>assets/img/compras.jpg" alt="">
				    	<div class="carousel-caption">
	                    </div>
				    </div>
				    <div class="item">
				    	<img src="<?php echo base_url(); ?>assets/img/compras.jpg" alt="">
				    	<div class="carousel-caption">
	                    </div>
				    </div>
				    </div>
				    <!-- Carousel nav -->
				    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			    </div>
			    <ul class="breadcrumb">
			    	<?php echo $this->breadcrumb->output(); ?>
				   <!-- <li><a href="#">Home</a> <span class="divider">/</span></li>
				    <li><a href="#">Library</a> <span class="divider">/</span></li>
				    <li class="active">Data</li>-->
    			</ul>
    			<div class="span3">
		          <div class="well sidebar-nav">
		            <ul class="nav nav-list">
		              <li class="nav-header">Sidebar</li>
		              <li class="active"><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li class="nav-header">Sidebar</li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li class="nav-header">Sidebar</li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		              <li><a href="#">Link</a></li>
		            </ul>
		          </div><!--/.well -->
		        </div>
	    		<div class="conteudo well"></div>
	    		<footer>
        			<div id="menu-footer"></div>
	                <p class="text-center">&copy; E-commerce. Todos os direitos reservados.</p>
	    		</footer>
	   			<script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
		    	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		    	<script src="<?php echo base_url(); ?>assets/js/bootstrap-carousel.js"></script>
		    	<script>
			    	$('.carousel').carousel({
			    	  interval: 3000
			    	})
	    		</script>
	    	</div>	
	    </body>
    </html>