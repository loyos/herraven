<div class="wrap">
<h2>Catálogo Producción 2 </h2>
<?php
if (!empty($articulos)) {
	echo $this->Form->create('Molde');
	foreach ($articulos as $m) { ?>
		<div class = "index_molde">
			<div class="imagen_molde fotos" style = "float:left">
				<?php 
				echo $this->Html->link(
					$this->Html->image('articulosProduccion/'.$m['Articulosproduccion']['imagen'], array("width" => "200",'class'=>'prim')),
					"../img/articulosProduccion/".$m['Articulosproduccion']['imagen'],
					array('escape' => false, 'class="fancybox primera"','data-fancybox-group' => $m['Articulosproduccion']['imagen'])
				);
				if(!empty($m['Articulosproduccion']['imagen1'])) { 
				echo $this->Html->link(
					$this->Html->image('articulosProduccion/'.$m['Articulosproduccion']['imagen1'], array('style'=>'display:none')),
					"../img/articulosProduccion/".$m['Articulosproduccion']['imagen1'],
					array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $m['Articulosproduccion']['imagen'],)
				);?>

				<?php
				}
				if(!empty($m['Articulosproduccion']['imagen2'])) { 
					echo $this->Html->link(
						$this->Html->image('articulosProduccion/'.$m['Articulosproduccion']['imagen2'], array('style'=>'display:none')),
						"../img/articulosProduccion/".$m['Articulosproduccion']['imagen2'],
						array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $m['Articulosproduccion']['imagen'],)
					);?>

					<?php
				}
				?>
			</div>
			<div class = "info_molde">
				<table class="molde">
					<tr>
						<th>Código</th>
						<th>Descripción</th>
						<th>Materia prima</th>
					</tr>
					<tr>
						<td><?php echo $m['Articulosproduccion']['codigo']?></td>
						<td><?php echo $m['Articulosproduccion']['descripcion']?></td>
						<td><?php echo $m['Materiasprimasproduccion']['descripcion']?></td>
					</tr>
					<tr>
						<th style ="padding-top: 42px;">Acciones</th>
					</tr>
					<tr>
						<td style="width:108px">
						<?php 
						echo $this->Form->input('cantidad',array(
							'label' => 'Cantidad ',
							'style' => 'width:35px',
							'name' => 'cantidad1['.$m['Articulosproduccion']['id'].']',
							'id' => $m['Articulosproduccion']['id'],
							'class' => 'input_cantidad'
						));
						echo '<div id="cantidad_piezas_'.$m['Articulosproduccion']['id'].'" style = "position:absolute">';
						echo '</div>';
						echo '<br>';
						echo $this->Form->submit('Pedir',array('class' => 'button', 'onclick' => 'activar('.$m['Articulosproduccion']['id'].')'));
						echo $this->Form->input('activo',array(
							'value' => 0,
							'type' => 'hidden',
							'name' => 'activo['.$m['Articulosproduccion']['id'].']',
							'id' => 'activo_'.$m['Articulosproduccion']['id'],
						));
						?>
						</td>
						<td style="vertical-align:top">
							(<?php echo $m['Materiasprimasproduccion']['unidad']; ?>)
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php
	}
} else {
	echo "<h3>No existen Artículos</h3>";
}
?>
</div>
<script>
function activar(id){
	val = $('input#activo_'+id).val('1');
}
</script>
<script>
$(document).ready(function() {
	$('.fancybox').fancybox();
});

$('.input_cantidad').keyup(function() {
	var cantidad = $(this).val();
	var articulo = $(this).attr('id');
	cantidad_piezas(cantidad,articulo);
});

function cantidad_piezas(cantidad,articulo){
	//alert(articulo);
	$.ajax({
		type: "POST",
		url: '<?php echo FULL_BASE_URL.'/articulosproduccions/cantidad_piezas.json' ?>',
		//url: '<?php echo FULL_BASE_URL.'/'.basename(dirname(APP)).'/articulosproduccions/cantidad_piezas.json' ?>',
		data: { cantidad: cantidad, articulo:articulo },
		dataType: "json"
	}).done(function( msg ) {
		$('#cantidad_piezas_'+articulo).html("Equivalente a "+msg+" piezas");
	});
}
</script>