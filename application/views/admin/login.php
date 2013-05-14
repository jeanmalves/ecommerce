<div class="well">
<?php echo form_open(base_url().'admin/login/user', array('id'=>'FormLogin', 'class'=>'form-horizontal'));?>
	<div class="control-group">
		<label class="control-label" for="inputLogin">Login</label>
		<div class="controls">
			<input type="text" name ="inputLogin" id="inputLogin" placeholder="Login" required>
			<?php echo form_error('inputLogin'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Senha</label>
		<div class="controls">
			<input type="password" name="inputPassword" id="inputPassword" placeholder="Senha" required>
			<?php echo form_error('inputPassword'); ?>
		</div>	
	</div>
	<div class="control-group">
		<div class="controls">
			<label class="checkbox"> <input type="checkbox">Lembre-me </label>
			<button type="submit" class="btn">Acessar</button>
		</div>
	</div>
<? echo form_close();?>
</div>