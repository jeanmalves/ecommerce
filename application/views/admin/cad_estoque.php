<div class="well">
	<p class="lead">Estoque - Entrada de Mercadorias</p>
	<?php echo form_open_multipart(base_url().'admin/estoque/cadastrar-estoque', array('id'=>'FormEstoque', 'class'=>'form-horizontal'));?>
		<div class="control-group">
			<label class="control-label" for="inputNome">Produto</label>
			<div class="controls">
				<?php  echo form_dropdown('inputProduto', $produto, value_field('inputProduto'),'required'). form_error('inputProduto'); ?>
			</div>
			<div class="controls"><small><?php echo form_error('inputProduto');?></small></div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputQtde">Quantidade</label>
			<div class="controls">
				<input class="input-mini" name="inputQtde" type="text" placeholder="valor" required>
			</div>
			<div class="controls"><small><?php echo form_error('inputQtde');?></small></div>
		</div>	
		<div class="control-group">
			<label class="control-label" for="inputMin">Estoque Mínimo</label>
			<div class="controls">
				<input class="input-mini" name="inputMin" type="text" placeholder="valor" required>
			</div>
			<div class="controls"><small><?php echo form_error('inputMin');?></small></div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPreco">Preço</label>
			<div class="controls">
				<input class="span2" name="inputPreco" id="inputPreco" type="text" placeholder="valor em R$" required>
			</div>
			<div class="controls"><small><?php echo form_error('inputPreco');?></small></div>
		</div>
		<div class="control-group">
			<div class="controls">
			    <button type="submit" class="btn">Salvar</button>
			</div>
		</div>    
	<?php echo form_close();?>
</div>