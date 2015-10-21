<table class="tabla_index" width='100%';>
	<tr>
	<th style="border-bottom:2px solid black; padding: 5px;">Acción</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Nombre</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Precio</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Unidad</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Total entradas</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Total salidas</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Saldo</th>
	</tr>
	<?php
	foreach($materiasprima as $m) {
		if (!empty( $entradas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
			$entrada1 = $entradas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'] ;
			$entrada = number_format($entrada1,2,',','.');
		} else {
			$entrada1 = 0;
			$entrada = 0;
		}
		if (!empty($salidas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'])){
			$salida1 = $salidas_materia[$m['Materiasprima']['id']][0][0]['SUM(`Inventariomaterial`.`cantidad`)'];
			$salida = number_format($salida1,2,',','.');
		} else {
			$salida1 = 0;
			$salida = 0;
		}
		$saldo = $entrada1 -$salida1;
		$saldo = number_format($saldo,2,',','.');
		echo '<tr>';
		echo '<td style="text-align:center; padding: 5px;">'.$this->Html->link('Editar MP',array('controller' => 'materiasprimas','action' => 'admin_editar',$m['Materiasprima']['id']),array('class'=>'boton_accion')).'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$m['Materiasprima']['descripcion'].'</td>';
		echo '<td style="text-align:center; padding: 5px;"> Bs '.$m['Materiasprima']['precio'].'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$m['Materiasprima']['unidad'].'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$entrada.'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$salida.'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$saldo.'</td>';
		echo '</tr>';
	}
	echo '</table>';
	?>