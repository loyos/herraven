<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Proveedor</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Denominación Legal</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['denominacion_legal'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>RIF</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['rif'];	
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Representante</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['representante'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Email de representante</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['email_representante'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Ciudad</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['ciudad'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Teléfono</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['telefono'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Telefono</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['telefono2'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Sitio Web</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['web'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Dirección</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['direccion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Descripción</th>';
	echo '<td>';
	echo $proveedor['Proveedor']['descripcion'];
	echo '</td>';
	echo '</tr>';
	if (!empty($proveedor['Herramienta'])) {
		echo '<tr>';
		echo '<th>Herramientas que provee</th>';
		echo '<td>';
		foreach ($proveedor['Herramienta'] as $h){
			echo $h['nombre'].'<br>';
		}
		echo '</td>';
		echo '</tr>';
	}
	if (!empty($proveedor['Insumo'])) {
		echo '<tr>';
		echo '<th>Insumos que provee</th>';
		echo '<td>';
		foreach ($proveedor['Insumo'] as $h){
			echo $h['nombre'].'<br>';
		}
		echo '</td>';
		echo '</tr>';
	}
	if (!empty($proveedor['Materiasprima'])) {
		echo '<tr>';
		echo '<th>Materias prima que provee</th>';
		echo '<td>';
		foreach ($proveedor['Materiasprima'] as $h){
			echo $h['descripcion'].'<br>';
		}
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
?>
</div>
