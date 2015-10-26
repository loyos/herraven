<table class="tabla_index" width='100%';>
	<tr>
	<th style="border-bottom:2px solid black; padding: 5px;">Acciones</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Nombre</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Total entradas</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Total salidas</th>
	<th style="border-bottom:2px solid black; padding: 5px;">Saldo</th>
	</tr>
	<?php
	foreach($insumos as $a) {
		if (!empty( $entradas_insumo[$a['Insumo']['id']][0][0]['SUM(`Inventarioinsumo`.`cantidad`)'])) {
			$entrada1 = $entradas_insumo[$a['Insumo']['id']][0][0]['SUM(`Inventarioinsumo`.`cantidad`)'] ;
			$entrada = number_format($entrada1,2,',','.');
			// $entrada = $entrada1;
		} else {
			$entrada1 = 0;
			$entrada = 0;
		}
		if (!empty($salidas_insumo[$a['Insumo']['id']][0][0]['SUM(`Inventarioinsumo`.`cantidad`)'])){
			$salida1 = $salidas_insumo[$a['Insumo']['id']][0][0]['SUM(`Inventarioinsumo`.`cantidad`)'];
			$salida = number_format($salida1,2,',','.');
			// $salida = $salida1;
		} else {
			$salida1 = 0;
			$salida = 0;
		}
		$saldo = $entrada1 -$salida1;
		$saldo = number_format($saldo,2,',','.');
		echo '<tr>';
		echo '<td style="text-align:center; padding: 5px;">';
			echo $this->Html->link('Editar',array('controller' => 'insumos','action'=>'admin_editar',$lote_id,$a['Insumo']['id']),array('class'=>'boton_accion'));
			if (in_array($a['Insumo']['id'],$borrar)) {
				echo ' ';
				echo $this->Html->link('Eliminar',array('controller' => 'insumos','action'=>'admin_eliminar',$lote_id,$a['Insumo']['id']),array('class'=>'boton_accion'));
			}
		
		echo $this->Html->link('Movimientos', array('controller' => 'inventarioinsumos', 'action' => 'admin_movimientos', $lote_id, $a['Insumo']['nombre'] ), array('class'=>'boton_accion') );

		echo '</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$a['Insumo']['nombre'].'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$entrada.'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$salida.'</td>';
		echo '<td style="text-align:center; padding: 5px;">'.$saldo.'</td>';
		echo '</tr>';
	}
	echo '</table>';
	?>