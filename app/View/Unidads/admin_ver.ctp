<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Unidad</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Unidad</th>';
	echo '<td>';
	echo $unidad['Unidad']['numero'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Nombre</th>';
	echo '<td>';
	echo $unidad['Unidad']['nombre'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Jefe de la unidad</th>';
	echo '<td>';
	echo $unidad['User']['nombre'].' '.$unidad['User']['apellido'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Personal</th>';
	echo '<td>';
	echo $personal;
	echo '</td>';
	echo '</tr>';
	echo '</table>';
?>
</div>
