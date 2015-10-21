<table class="tabla_index" width='100%';>
	<tr>
	<th style="border-bottom:2px solid black; padding: 5px;">Código</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Descripción</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Total entradas</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Total salidas</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Saldo</th>
	</tr>
	<?php
	foreach($articulos as $a) {
		if (!empty( $entradas_articulo[$a['Articulosproduccion']['id']][0][0]['SUM(`Inventarioarticulosproduccion`.`cantidad`)'])) {
			$entrada1 = $entradas_articulo[$a['Articulosproduccion']['id']][0][0]['SUM(`Inventarioarticulosproduccion`.`cantidad`)'] ;
			//$entrada = number_format($entrada1,2,',','.');
			$entrada = $entrada1;
		} else {
			$entrada1 = 0;
			$entrada = 0;
		}
		if (!empty($salidas_articulo[$a['Articulosproduccion']['id']][0][0]['SUM(`Inventarioarticulosproduccion`.`cantidad`)'])){
			$salida1 = $salidas_articulo[$a['Articulosproduccion']['id']][0][0]['SUM(`Inventarioarticulosproduccion`.`cantidad`)'];
			//$salida = number_format($salida1,2,',','.');
			$salida = $salida1;
		} else {
			$salida1 = 0;
			$salida = 0;
		}
		$saldo = $entrada1 -$salida1;
		//$saldo = number_format($saldo,2,',','.');
		echo '<tr>';
		echo '<td style="text-align:center; padding: 5px;">'.$a['Articulosproduccion']['codigo'].'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$a['Articulosproduccion']['descripcion'].'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$entrada.'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$salida.'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$saldo.'</td>';
		echo '</tr>';
	}
	echo '</table>';
	?>