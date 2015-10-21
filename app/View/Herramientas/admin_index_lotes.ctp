<div class='wrap'>
<?php echo $this->Html->link('Agregar lote de insumos',array('controller' => 'insumos','action'=>'admin_editar_lote'),array('class'=>'boton'));?>
<?php echo ' '.$this->Html->link('Agregar lote herramientas',array('action'=>'admin_editar_lote'),array('class'=>'boton'));?>
<h1>Lotes de Insumos y Herramientas</h1>
<?php
if (!empty($lotes_insumos) || !empty($lotes_herramientas)) {
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Lote</th>';
	echo '<th>Tipo</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($lotes_insumos as $l) {
		echo '<tr>';
		echo '<td>'.$l['Lote']['nombre'].'</td>';
		echo '<td>Insumos</td>';
		echo '<td>'.$this->Html->link('Editar',array('controller' => 'insumos','action'=>'admin_editar_lote',$l['Lote']['id']),array('class'=>'boton_accion')).' '.$this->Html->link('Eliminar',array('controller' => 'insumos','action'=>'admin_eliminar_lote',$l['Lote']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar? Se eliminarán todos los insumos asociadas a este lote').'</td>';
		echo '</tr>';
	}
	foreach ($lotes_herramientas as $l) {
		echo '<tr>';
		echo '<td>'.$l['Lotesherramienta']['nombre'].'</td>';
		echo '<td>Herramientas</td>';
		echo '<td>'.$this->Html->link('Editar',array('action'=>'admin_editar_lote',$l['Lotesherramienta']['id']),array('class'=>'boton_accion')).' '.$this->Html->link('Eliminar',array('action'=>'admin_eliminar_lote',$l['Lotesherramienta']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar? Se eliminarán todas las herramientas asociadas a este lote').'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '<h3>No hay lotes de herramientas registrados</h3>';
}
?>
</div>