<?php
if (!empty($entradas)) {
	?>
	<br>
	<table class="tabla_index" style="clear: left;">
	<tr>
	<th>Trimestre</th>
	<th>Saldo incial</th>
	<th>Total entradas</th>
	<th>Total salidas</th>
	<th>Saldo al cierre</th>
	<th>Acciones</th>
	</tr>
	<?php
	foreach($entradas as $key => $m) {
		if (!empty($m[0][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
			$entrada1 = $m[0][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			//$entrada = number_format($entrada1,2,',','.');
		} else {
			$entrada = 0;
			$entrada1 = 0;
		}
		if (!empty($salidas[$key][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
			$salida1 = $salidas[$key][0][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			//$salida = number_format($salida1,2,',','.');
		} else {
			$salida = 0;
			$salida1 = 0;
		}
		if (!empty($entradas[$key-1])) {
			
			if (!empty($entradas[$key-1][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
				$e_inicial = $entradas[$key-1][0][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			} else {
				$e_inicial = 0;
			}
			if (!empty($salidas[$key-1][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
				$s_inicial = $salidas[$key-1][0][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			} else {
				$s_inicial = 0;
			}
			$saldo_inicial = floatval($e_inicial)-floatval($s_inicial);
			$saldo_inicial = number_format($saldo_inicial,2,',','.');
		} else {
			$saldo_inicial = 'Sin registrar';
		}
		if ($m[0]['Inventariomaterial']['trimestre'] == $trimestre) {
			$saldo = $entrada1-$salida1;
			$saldo = number_format($saldo,2,',','.');
			$saldo = $saldo.' (Trimestre en curso)';
		} else {
			$saldo = $entrada1-$salida1;
			$saldo = number_format($saldo,2,',','.');
		}
		echo '<tr>';
		echo '<td>'.$m[0]['Inventariomaterial']['trimestre'].'</td>';
		echo '<td>'.$saldo_inicial.'</td>';
		echo '<td>'.number_format($entrada1,2,',','.').'</td>';
		echo '<td>'.number_format($salida1,2,',','.').'</td>';
		echo '<td>'.$saldo.'</td>';
		echo '<td>'.$this->Html->link('Consultar',array('action' => 'admin_consultar_movimientos',$materia,$m[0]['Inventariomaterial']['trimestre'],$ano),array('class'=>'boton_accion')).'</td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo 'No hay movimientos registrados';
}