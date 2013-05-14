<div class="navbar navbar-inverse">
      <div class="navbar-inner">
        <div class="container">
          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a href="./index.html" class="brand">Menu</a> -->
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="<?php echo base_url()."admin";?>">Home</a>
              </li>
              <li class="">
                <a href="#">Usuários</a>
              </li>
              <li class="dropdown">
              	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Produtos
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
				  <li><a href="<?php echo base_url();?>admin/produto">Produtos Cadastrados</a></li>	
                  <li><a href="<?php echo base_url();?>admin/produto/cadastrar-produto">Cadastrar Produtos</a></li>
                  <!-- <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>-->
                  <li class="divider"></li> 
                  <!-- <li><a href="#">Separated link</a></li>-->
                </ul>
              </li>
              <li class="">
                <a href="#">Fornecedores</a>
              </li>
              <li class="active dropdown">
              	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					Estoque
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
                  <li><a href="<?php echo base_url();?>admin/estoque">Lista Estoque</a></li>
                  <li><a href="<?php echo base_url();?>admin/estoque/cadastrar-estoque">Entrada</a></li>
                  <li class="divider"></li>
                </ul>
               <!-- <form class="navbar-search pull-left" action="">
					<input class="search-query span2" type="text" placeholder="Search">
				</form>-->
              </li>
            </ul>
          </div>
        </div>
      </div>
</div>