<div class='wrap'>
<div class="info1_derecha">
<?php echo $this->Html->link('Proveedores',array('action' => 'admin_listar_proveedores',$lote_id),array('class'=>'boton'))?>
</div>
<h1>Inventario de Herramientas</h1>
<h1><?php echo $lote ?></h1>
<?php
if (!empty($herramientas)) {
	foreach ($herramientas as $l) { ?>
		<div>
			<div class = "index_herramienta" style="float:left">
				<table class="herramienta">
					<tr>
						<td>
							<table>
								<tr>
									<th>Herramienta</td>
									<td><?php echo $l['Herramienta']['nombre']?></td>
								</tr>
								<tr>
									<th>Fecha</td>
									<td><?php echo $l['Herramienta']['fecha']?></td>
								</tr>
								<tr>
									<th>Precio</td>
									<td><?php echo $l['Herramienta']['precio']?></td>
								</tr>
							</table>
						</td>
						<td>
							<table>
								<tr>
									<th>Descripción</td>
									<td><?php echo $l['Herramienta']['descripcion']?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="imagen_herramienta fotos">
				<?php 
				echo $this->Html->link(
					$this->Html->image('herramientas/'.$l['Herramienta']['imagen'], array("width" => "200","height" => "200",'class'=>'prim')),
					"../img/herramientas/".$l['Herramienta']['imagen'],
					array('escape' => false, 'class="fancybox primera"','data-fancybox-group' => $l['Herramienta']['imagen'])
				);
				if(!empty($l['Herramienta']['imagen1'])) { 
				echo $this->Html->link(
					$this->Html->image('herramientas/'.$l['Herramienta']['imagen1'], array('style'=>'display:none')),
					"../img/herramientas/".$l['Herramienta']['imagen1'],
					array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $l['Herramienta']['imagen'],)
				);?>

				<?php
				}
				if(!empty($l['Herramienta']['imagen2'])) { 
					echo $this->Html->link(
						$this->Html->image('herramientas/'.$l['Herramienta']['imagen2'], array('style'=>'display:none')),
						"../img/herramientas/".$l['Herramienta']['imagen2'],
						array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $l['Herramienta']['imagen'],)
					);?>

					<?php
				}
				?>
			</div>
		</div>
	<?php	
	}
} else {
	echo '<h3>No hay herramientas registradas</h3>';
}
?>
</div>
<script>
	$(document).ready(function() {
	$('.fancybox').fancybox();
	

});
</script>