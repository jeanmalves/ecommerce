<?php
	echo form_open("admin/produto");
?>
<label form="nome"/>Nome:</label>
<input type="text" name="nome" value="<?php set_value() ?>" />

<label form="descricao"/>Descrição:</label>
<input type="text" name="descricao" value="<?php set_value() ?>" />

<?php
	echo form_close();
?>
