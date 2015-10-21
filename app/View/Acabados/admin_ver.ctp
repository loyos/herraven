<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'));
?>
<h1>Usuario</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Usuario</th>';
	echo '<td>';
	echo $usuario['User']['username'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Nombre y apellido</th>';
	echo '<td>';
	echo $usuario['User']['nombre'].' '.$usuario['User']['apellido'];;	
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Email</th>';
	echo '<td>';
	echo $usuario['User']['email'];;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Rol</th>';
	echo '<td>';
	echo $usuario['User']['rol'];;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Funciones</th>';
	echo '<td>';
	echo $funciones;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Cliente</th>';
	echo '<td>';
	echo $usuario['Cliente']['denominacion_legal'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
?>
</div>
