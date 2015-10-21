<div class="wrap">
<?php echo $this->element('search_catalogo_produccion'); ?>
<?php echo $this->Html->link("Regresar",array('controller' => 'pedidosmoldes','action' => 'admin_index'),array('class' => 'boton'));?>
<h2>Catálogo Producción 1 </h2>
<?php
if (!empty($moldes)) {
	echo $this->Form->create('Molde');
	foreach ($moldes as $m) { ?>
		<div class = "index_molde">
			<div class="imagen_molde fotos" style = "float:left">
				<?php 
				echo $this->Html->link(
					$this->Html->image('moldes/'.$m['Molde']['imagen_1'], array("width" => "200",'class'=>'prim')),
					"../img/moldes/".$m['Molde']['imagen_1'],
					array('escape' => false, 'class="fancybox primera"','data-fancybox-group' => $m['Molde']['imagen_1'])
				);
				if(!empty($m['Molde']['imagen_2'])) { 
				echo $this->Html->link(
					$this->Html->image('moldes/'.$m['Molde']['imagen_2'], array('style'=>'display:none')),
					"../img/moldes/".$m['Molde']['imagen_2'],
					array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $m['Molde']['imagen_1'],)
				);?>

				<?php
				}
				if(!empty($m['Molde']['imagen_3'])) { 
					echo $this->Html->link(
						$this->Html->image('moldes/'.$m['Molde']['imagen_3'], array('style'=>'display:none')),
						"../img/moldes/".$m['Molde']['imagen_3'],
						array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $m['Molde']['imagen_1'],)
					);?>

					<?php
				}
				?>
			</div>
			<div class = "info_molde">
				<table class="molde">
					<tr>
						<th>Código</th>
						<th>Medidas</th>
						<th>Cavidades</th>
						<th>Ubicación</th>
					</tr>
					<tr>
						<td><?php echo $m['Molde']['codigo']?></td>
						<td><?php echo $m['Molde']['medidas']?></td>
						<td><?php echo $m['Molde']['cavidades']?></td>
						<td><?php echo $m['Molde']['ubicacion']?></td>
					</tr>
					<tr>
						<th style ="padding-top: 42px;">Anotaciones</th>
						<th colspan ="2" style ="padding-top: 42px;">Comentario</th>
						<th style ="padding-top: 42px;">Acciones</th>
					</tr>
					<tr>
						<td><?php echo $m['Molde']['anotaciones']?></td>
						<td colspan ="2">
						<?php 
						echo $this->Form->input('Pedidosmolde.comentario',array(
							'label' => false,
							'name' => 'comentario['.$m['Molde']['id'].']'
						));
						?>
						</td>
						<td>
						<?php 
						echo $this->Form->input('Pedidosmolde.cantidad',array(
							'label' => 'Inyecciones ',
							'style' => 'width:35px',
							'name' => 'cantidad['.$m['Molde']['id'].']'
						));
						echo '<br>';
						echo $this->Form->submit('Pedir',array('class' => 'button', 'onclick' => 'activar('.$m['Molde']['id'].')'));
						echo $this->Form->input('activo',array(
							'value' => 0,
							'type' => 'hidden',
							'name' => 'activo['.$m['Molde']['id'].']',
							'id' => 'activo_'.$m['Molde']['id'],
						));
						?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php
	}
} else {
	echo "<h3>No existen Moldes</h3>";
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
</script>