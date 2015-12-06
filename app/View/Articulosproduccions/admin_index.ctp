<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar',$subcategoria_id),array('class'=>'boton'));
?>
<h1>Artículos</h1>
<?php 
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Foto</th>	
		<th>Código</th>
		<th>Descripcion</th>
		<th>Materia Prima Asociada</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($articulos as $c) {
			echo '<tr>';
			echo '<td>';
			echo $this->Html->link(
			$this->Html->image('articulosProduccion/'.$c['Articulosproduccion']['imagen'], array("width" => "100px",'class'=>'prim','data-fancybox-group' => '1')),
			"../img/articulosProduccion/".$c['Articulosproduccion']['imagen'],
			array('escape' => false, 'class'=>"fancybox primera",'data-fancybox-group' => $c['Articulosproduccion']['id'],)
				);
				
				if(!empty($c['Articulosproduccion']['imagen1'])) { 
					echo $this->Html->link(
						$this->Html->image('articulosProduccion/'.$c['Articulosproduccion']['imagen1'], array('style'=>'display:none')),
						"../img/articulosProduccion/".$c['Articulosproduccion']['imagen1'],
						array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $c['Articulosproduccion']['id'],)
					);?>

					<?php
				}
				if(!empty($c['Articulosproduccion']['imagen2'])) { 
					echo $this->Html->link(
						$this->Html->image('articulosProduccion/'.$c['Articulosproduccion']['imagen2'], array('style'=>'display:none')),
						"../img/articulosProduccion/".$c['Articulosproduccion']['imagen2'],
						array('escape' => false, 'class'=>"fancybox",'data-fancybox-group' => $c['Articulosproduccion']['id'],)
					);?>

					<?php
				}
			echo '</td>';
			echo '<td>'.$c['Articulosproduccion']['codigo'].'</td>';
			echo '<td>'.$c['Articulosproduccion']['descripcion'].'</td>';
			echo '<td>'.$c['Materiasprimasproduccion']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Articulosproduccion']['id'],$subcategoria_id),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay artículos</h3>';
	}
?>
</div>
<script>
$(document).ready(function() {
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	var is_firefox = navigator.userAgent.indexOf("Firefox") != -1;
	
	$('.fancybox').fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
	



});
</script>