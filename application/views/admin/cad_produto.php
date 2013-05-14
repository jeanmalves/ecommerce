<div class="well">
	<p class="lead">Cadastro de Produtos</p>
	<?php echo form_open_multipart(base_url().'admin/produto/cadastrar-produto', array('id'=>'FormProduto', 'class'=>'form-horizontal'));?>
		<div class="control-group">
			<label class="control-label" for="inputNome">Nome</label>
			<div class="controls">
				<input type="text" id="inputNome" name="inputNome" placeholder="Nome do Produto" required>
			</div>
			<div class="controls"><small><?php echo form_error('inputNome');?></small></div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputDesc">Descrição</label>
			<div class="controls">
			<textarea id="inputDesc" name="inputDesc" rows="3"></textarea>
			</div>
			<div class="controls"><small><?php echo form_error('inputDesc');?></small></div>
		</div>	
		<div class="control-group">
			<label class="control-label" for="inputFoto">Foto do Produto</label>
			<div class="controls">
				<input type="file" name="file[]" multiple="multiple" accept="image/jpg,image/jpeg,image/gif,image/png">
				<?php //echo form_input(array('type'=>'file', 'id'=>'inputFoto', 'name'=>'inputFoto'),value_field('inputFoto')); ?>
			</div>
			<div class="controls"><small>Insira apenas uma imagem.</small></div>
			<div class="controls"><small><?php echo form_error('inputDesc');?></small></div>
		</div>
		<div class="controls">
			<!-- <img src="<?php echo base_url();?>assets/img/logo.png" class="img-polaroid">-->
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">
					<input type="radio" name="optionsRadiosAtivo" id="optionsRadiosAtivo" value="1" checked>
					Ativo
				</label>
				<label class="radio">
					<input type="radio" name="optionsRadiosAtivo" id="optionsRadiosAnativo" value="0">
					Inativo
				</label>
			</div>	
		</div>
		<div class="control-group">
			<div class="controls">
			    <button type="submit" class="btn">Savar</button>
			</div>
		</div>    
	<?php echo form_close();?>
</div>