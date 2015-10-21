<?php
echo $hoy;
?>
<h1>Artículo</h1>
/* <?php  */
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Imagen</th>';
	echo '<td style = "border-bottom: 1px solid black;  padding-bottom:10px; padding-top:10px;">';
	echo '<img src="http://web.herraven.com/img/articulos/'.$articulo['Articulo']['imagen'].'" width="100px">';
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Articulo</th>';
	echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
	echo $articulo['Articulo']['codigo'];
	echo '</td>';
	echo '</tr>';
	echo '<tr style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Descripción</th>';
	echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
	echo $articulo['Articulo']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Cantidad por cajas</th>';
	echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
	echo $articulo['Articulo']['cantidad_por_caja'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Oculto</th>';
	echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
	if ($articulo['Articulo']['oculto'] == 1){
		$oculto = 'Si';
	} else {
		$oculto = 'No';
	}
	echo $oculto;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Subcategoria</th>';
	echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
	echo $articulo['Subcategoria']['descripcion'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<br><br>';
	echo '<h3>Composición</h3>';
	echo '<table class="tabla_ver">';
	echo '<tr>';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Materias prima básicas</th>';
	echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
	foreach ($articulo['Materiasprima'] as $m){
		echo $m['descripcion'].': '.$m['ArticulosMateriasprima']['cantidad'].' '.$m['unidad'].'<br>';
	}
	echo '</td>';
	echo '</tr>';
	if (!empty($acabados)){
		foreach ($acabados as $a){
			echo '<tr>';
			echo '<th style="text-align:right; border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">'.$a['acabado'].':</th>';
			echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';	
			foreach ($a['materia'] as $p) {
				echo '<div class="tres_espacios">'.$p.'</div>';
			}
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	echo '<br><br>';
	echo '<h3>Costos</h2>';
	echo '<table class="tabla_ver">';
	echo '<tr>';
	echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Materias primas básicas</th>';
	echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">'.$this->Herra->format_number($costo_materiaprima).'</td>';
	echo '</tr>';
	if (!empty($costo_acabado)) {
		
		foreach ($costo_acabado as $a) {
			if ($a['acabado'] != 'Sin acabado asociado') {
				echo '<tr>';
				echo '<th style="border-bottom: 1px solid black; text-align:right; padding-bottom:10px; padding-top:10px;">'.$a['acabado'].':</th>';
				echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
				echo '<div>'.$this->Herra->format_number($a['monto']).'</div>';
				echo '</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
		echo '</br></br>';
		echo '<table class="tabla_ver">';
		echo '<tr>';
		echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:30px;">Costo de producción</th>';
		echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:30px;">';
		echo $articulo['Articulo']['costo_produccion'].'%';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">Margen de ganancia</th>';
		echo '<td style = "border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
		echo $articulo['Articulo']['margen_ganancia'].'%';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '<br><br>';
		echo '<h3>Precio de venta</h2>';
		echo '<table class="tabla_ver">';
		foreach ($costo_acabado as $a) {
			echo '<tr>';
			echo '<th style="text-align:right; border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">'.$a['acabado'].':</th>';
			echo '<td style="border-bottom: 1px solid black; padding-bottom:10px; padding-top:10px;">';
			$precio_materias = $a['monto']+$costo_materiaprima;
			$costo_produccion = ($a['monto']+$costo_materiaprima)*($produccion/100);
			$costo_total = $precio_materias + $costo_produccion;
			$margen_ganancia = $costo_total * ($ganancia/100);
			$precio_total = $costo_total + $margen_ganancia;
			echo '<div>'.$this->Herra->format_number($precio_total).'</div>';
			echo '</td>';
			echo '</tr>';
			
		}
		echo '</table>';
		
	} else {
		echo '</table>';
		echo '</br>';
		echo '<table class="tabla_ver">';
		echo '<th>Costo de producción</th>';
		echo '<td>';
		echo $articulo['Articulo']['costo_produccion'].'%';
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th>Margen de ganancia</th>';
		echo '<td>';
		echo $articulo['Articulo']['margen_ganancia'].'%';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '<h3>Precio de venta</h2>';
		echo '<table class="tabla_ver">';
		echo '<tr>';
		echo '<td>';
		$costo_produccion = ($costo_materiaprima)*($produccion/100);
		$costo_total = $costo_materiaprima + $costo_produccion;
		$margen_ganancia = $costo_total * ($ganancia/100);
		$precio_total = $costo_total + $margen_ganancia;
		echo '<div class="tres_espacios">'.$this->Herra->format_number($precio_total).'</div>';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
	}	

?>