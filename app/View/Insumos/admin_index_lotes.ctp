<div class='wrap'>
<?php echo $this->Html->link('Agregar lote',array('action'=>'admin_editar_lote'),array('class'=>'boton'));?>
<h1>Lotes de Insumos</h1>
<?php
if (!empty($lotes)) {
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Lote</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($lotes as $l) {
		echo '<tr>';
		echo '<td>'.$l['Lote']['nombre'].'</td>';
		echo '<td>'.$this->Html->link('Editar',array('action'=>'admin_editar_lote',$l['Lote']['id']),array('class'=>'boton_accion')).' '.$this->Html->link('Eliminar',array('action'=>'admin_eliminar_lote',$l['Lote']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar? Se eliminarán todos los insumos asociadas a este lote').'</td>';
		echo '</tr>';
	}
	echo '<table>';
} else {
	echo '<h3>No hay lotes de insumos registrados</h3>';
}
?>
</div>