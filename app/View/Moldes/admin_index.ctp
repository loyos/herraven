<div class="wrap">
<div>
	<?php echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=> 'boton')); ?>
	<br><br>
</div>
<?php
if (!empty($moldes)) {
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
						<th style ="padding-top: 42px;">Materia Prima</th>
						<th style ="padding-top: 42px;">Cantidad de MP por Molde</th>
						<th style ="padding-top: 42px;">Acciones</th>
					</tr>
					<tr>
						<td style="max-width: 150px;"><?php echo $m['Molde']['anotaciones']?></td>
						<td><?php echo $m['Materiasprimasmolde']['descripcion']?></td>
						<td><?php echo $m['Molde']['cantidad']?></td>
						<td><?php echo $this->Html->link('Editar',array('action' => 'admin_editar',$m['Molde']['id']))?></td>
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
	$(document).ready(function() {
	$('.fancybox').fancybox();
	

});
</script>