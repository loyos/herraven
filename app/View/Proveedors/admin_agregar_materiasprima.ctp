<div class='wrap'>
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Materias Prima</h1>
<?php 
if(!empty($materias_proveedor['Materiasprima'])){
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Materia Prima</th>';
	echo '<th>Precio</th>';
	echo '<th>Acciones</th>';
	echo '</tr>';
	foreach ($materias_proveedor['Materiasprima'] as $h) {
		echo '<tr>';
		echo '<td>'.$h['descripcion'].'</td>';
		echo '<td>'.$h['MateriasprimasProveedor']['precio'].'</td>';
		echo '<td>'.$this->Html->link('Eliminar',array('action'=>'admin_eliminar_materiasprima',$id,$h['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '<h3>No hay Materias prima asociadas a este proveedor</h3>';
}
echo '<h3>Agregar Materia Prima</h3>';
echo $this->Form->create('MateriasprimasProveedor');
echo $this->Form->input('materiasprima_id');
echo $this->Form->input('precio');
echo $this->Form->input('proveedor_id',array('value'=>$id,'type'=>'hidden'));
echo $this->Form->submit('Agregar', array('class' => 'button'));
echo $this->Form->end;
?>
</div>