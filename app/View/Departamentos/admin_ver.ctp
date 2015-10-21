<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Departamento</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Departamento</th>';
	echo '<td>';
	echo $departamento['Departamento']['numero'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Nombre</th>';
	echo '<td>';
	echo $departamento['Departamento']['nombre'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Jefe de la unidad</th>';
	echo '<td>';
	echo $departamento['User']['nombre'].' '.$departamento['User']['apellido'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Unidades</th>';
	echo '<td>';
	echo $unidades;
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
