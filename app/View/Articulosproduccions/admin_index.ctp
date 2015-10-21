<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Artículos</h1>
<?php 
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Código</th>
		<th>Descripcion</th>
		<th>Materia Prima Asociada</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($articulos as $c) {
			echo '<tr>';
			echo '<td>'.$c['Articulosproduccion']['codigo'].'</td>';
			echo '<td>'.$c['Articulosproduccion']['descripcion'].'</td>';
			echo '<td>'.$c['Materiasprimasproduccion']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array('action' => 'admin_editar',$c['Articulosproduccion']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Articulosproduccion']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Articulosproduccion']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?');
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay artículos</h3>';
	}
?>
</div>
