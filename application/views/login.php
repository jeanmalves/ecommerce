<?php echo form_open(base_url().'login/loja', array('id'=>'FormPlano', 'class'=>'form-horizontal'));?>
	<div class="control-group">
		<label class="control-label" for="inputLogin">Login</label>
		<div class="controls">
			<input type="text" name ="inputLogin" id="inputLogin" placeholder="Login">
			<?php echo form_error('inputLogin'); ?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Senha</label>
		<div class="controls">
			<input type="password" name="inputPassword" id="inputPassword" placeholder="Senha"></div>
			<?php echo form_error('inputPassword'); ?>
	</div>
	<div class="control-group">
		<div class="controls">
			<label class="checkbox"> <input type="checkbox">Lembre-me </label>
			<button type="submit" class="btn">Acessar</button>
		</div>
	</div>
<? echo form_close();?>