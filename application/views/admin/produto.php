<div class="well">
	<p class="lead">Produtos - Produtos Cadastrados Atualmente</p>
	<table class="table  table-bordered">
		  <thead>
			<tr>
				<th>Produto</th>
				<th>Descrição</th>
				<th>Status</th>
				<th colspan="2">Ação</th>
			</tr>
		</thead>
	    <tbody>
	    <?php 
			if($listagem){
				foreach($listagem as $chv => $valor)
				{
					echo  $valor;
				}
		?>
			<td colspan="4"><strong>Total de Produtos R$:</strong></td>
			<td colspan="2"><strong><?php echo $total; ?></strong></td>
		</tbody>
	</table>
	<div class="pagination pagination-small">
		<ul><?php echo $links_paginacao; ?></ul>
	</div>
		<?php 
		}
		?>	
</div>

