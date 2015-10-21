<div class = "wrap">
	<h1>Mis Pedidos despachados</h1>
	<?php 
	if (!empty($pedidos)) {
	foreach($pedidos as $p){ ?>
	<div class = "articulo_catalogo">
		<div class = "imagen_catalogo fotos">
			<?php
				echo $this->Html->image('articulos/'.$p['Articulo']['imagen'], array("height" => "120px",'class'=>'prim'));
			?>
		</div>
		<div class = "preview">
			<?php
				
				echo $p['Articulo']['codigo'].' <br> '.$p['Pedido']['status'].'<br>';
				// if (!empty($p['Acabado']['acabado'])) {
					// echo $p['Acabado']['acabado'];
				// } else {
					// echo 'Sin acabado';
				// }
				// echo '<br>';
				 echo '<span>'.  $p['Articulo']['descripcion'] . '</span>';
				 ?>
			<div class = 'ver_mas'>
				Ver Detalle
			</div>
		</div>
		<div class = "info_catalogo" style = "float: left;">
			<table>
				<tr>
					<td>
						Código
					</td>
					<td>
						Acabado
					</td>
					<td>
						Estatus
					</td>
					<td>
						Fecha
					</td>
				</tr>
				<tr>
					<td style = "font-weight:bold">
						<?php echo $p['Articulo']['codigo'] ?>
					</td>
					<td style = "font-weight:bold">
						<?php 
						if (!empty($p['Acabado']['acabado'])) {
							echo $p['Acabado']['acabado'];
						} else {
							echo 'Sin acabado';
						}
						?>
					</td>
					<td style = "font-weight:bold">
						<?php echo $p['Pedido']['status'] ?>
					</td>
					<td style = "font-weight:bold">
						<?php echo $p['Pedido']['fecha'] ?>
					</td>
				</tr>
				<tr>	
					<td style="padding-top:20px;">Pz. caja</td>
					<td style="padding-top:20px;">Cantidad</td>
					<td colspan="2" style="padding-top:20px;text-decoration: underline">Descripción artículo:</td>
				</tr>
				<tr>
					<td style = "font-weight:bold">
						<?php echo $p['Articulo']['cantidad_por_caja'] ?>
					</td>
					<td style = "font-weight:bold">
						<?php echo $p['Pedido']['cantidad_cajas'] ?>
					</td>
					<td style = "font-weight:bold; text-align:left" colspan="2">
						<?php echo $p['Articulo']['descripcion'] ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php } 
	} else {
		echo 'No hay despachos registrados';
	}?>
</div>

<script>

	$('.ver_mas').click(function(){
		console.debug($(this).closest('.articulo_catalogo').find('.info_catalogo').toggle('fast'));
	})
	
	$('.articulo_catalogo').hover(
		function() {
			$( this ).find('.ver_mas').show();
			console.debug('in');
		  }, function() {
		  console.debug('out');
			$( this ).find('.ver_mas').hide();
		  }
	);

</script>