<div class="well">
	<p class="lead">Estoque - Produtos em Estoque Atualmente</p>
	<table class="table  table-bordered">
		  <thead>
			<tr>
				<th>Produto</th>
				<th>Estoque Mínimo</th>
				<th>Quantidade</th>
				<th>Preço R$</th>
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
			<td colspan="4"><strong>Total em Estoque R$:</strong></td>
			<td colspan="2"><strong><?php echo number_format($total,2,",","."); ?></strong></td>
		</tbody>
	</table>
	<div class="pagination pagination-small">
		<ul><?php echo $links_paginacao; ?></ul>
	</div>
		<?php 
		}
		?>	
</div>

