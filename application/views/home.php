<div class="conteudo">
	<div class= "well colorBack">
		<ul class="thumbnails">
		 <?php 
			if($listagem){
				foreach($listagem as $chv => $valor)
				{
					echo  $valor;
				}
		?>
		<div class="pagination pagination-small">
			<ul><?php echo $links_paginacao; ?></ul>
		</div>
		<?php 
		}
		?>	
		</ul>
	</div>
</div>
<style>
	.well{
	background-color:#fff;		
}
.thumbnail{
margin-left:1px;
}
</style>