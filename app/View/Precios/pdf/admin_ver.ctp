<div class="wrap">
<h1><?php echo $precio['Precio']['descripcion']?></h1>
<?php
if (!empty($acabado_seleccionado)) {
	if (!empty($acabado['Acabado']['acabado'])) {
		echo '<h3>('.$acabado['Acabado']['acabado'].')</h3><br>';
	} else {
		echo '<h3>(Sin Acabado)</h3><br>';
	}
?>
<?php 
	if (!empty($precio_articulo)) {
	echo '<table  style="width:100%" class="tabla_index">';
	echo '<tr>';
		echo '<th style="text-align:left">Codigo</th>';
		echo '<th style="text-align:left">Precio</th>';
		echo '<th style="text-align:left">Pz. por Caja</th>';
		echo '<th style="text-align:left">Precio Caja</th>';
	echo '</tr>';
	foreach ($precio_articulo as $a){
		echo '<tr>';
		echo '<td>'.$a['codigo'].'</td>';
		echo '<td>';
		echo $this->Herra->format_number($a['precio']);
		echo '</td>';
		echo '<td>'.$a['cantidad'].'</td>';
		echo '<td>'.$this->Herra->format_number($a['cantidad']*$a['precio']).'</td>';
		echo '</tr>';
	}
	echo '</table>';
	} else {
		echo '<h3>No hay artículos con este acabado</h3>';
	}
} else {
	echo 'Selecciona un acabado';
}
?>
</div>
