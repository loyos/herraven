<div class='wrap'>
<?php echo $this->Html->link('Agregar Insumo',array('action'=>'admin_editar'),array('class'=>'boton'));?>
<h1>Insumos</h1>
<?php
if (!empty($insumos)) {
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Insumo</th>';
	echo '<th>Lote</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($insumos as $l) {
		echo '<tr>';
		echo '<td>'.$l['Insumo']['nombre'].'</td>';
		echo '<td>'.$l['Lote']['nombre'].'</td>';
		echo '<td>'.$this->Html->link('Editar',array('action'=>'admin_editar',$l['Insumo']['id']),array('class'=>'boton_accion')).' '.$this->Html->link('Eliminar',array('action'=>'admin_eliminar',$l['Insumo']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '<h3>No hay insumos registrados</h3>';
}
?>
</div>