<div class="wrap">
<h1>Movimientos de Materia Prima</h1>
<?php 
	echo $this->Form->create('Inventariomaterial');
	if (!empty($id_m)) {
		$value = $id_m;
	} else {
		$value = 0;
	}
	echo $this->Form->input('materiasprima_id',array(
		'value' => $value
	));
	echo $this->Form->submit('Buscar',array('class' => 'button'));
	echo $this->Form->end();
	if (!empty($id_m)) {
		if (!empty($entradas)) {
			?>
			<div class="subtitulo_movimientos">
			<h2>Movimientos de <?php echo $entradas[0]['Materiasprima']['descripcion'] ?></h2>
			</div>
			<div class="ano_movimientos">
				<table>
					<tr>
						<td><b><u>Año</u></b></td><td><b><u>Unidad</b></u></td>
					</tr>
					<tr>
						<td style="text-align:center"><?php echo $ano?> </td>
						<td style="text-align:center"><?php echo $entradas[0]['Materiasprima']['unidad'] ?></td>
					</tr>
				</table>
			</div>
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
				if (!empty($m[0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
					$entrada = $m[0]['SUM(`Inventariomaterial`.`cantidad`)'];
				} else {
					$entrada = 0;
				}
				if (!empty($salidas[$key][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
					$salida = $salidas[$key][0]['SUM(`Inventariomaterial`.`cantidad`)'];
				} else {
					$salida = 0;
				}
				if (!empty($entradas[$key-1])) {
					
					if (!empty($entradas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
						$e_inicial = $entradas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'];
					} else {
						$e_inicial = 0;
					}
					if (!empty($salidas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'])) {
						$s_inicial = $salidas[$key-1][0]['SUM(`Inventariomaterial`.`cantidad`)'];
					} else {
						$s_inicial = 0;
					}
					$saldo_inicial = floatval($e_inicial)-floatval($s_inicial);
				} else {
					$saldo_inicial = 'Sin registrar';
				}
				if ($m['Inventariomaterial']['trimestre'] == $trimestre) {
					$saldo = $entrada-$salida;
					$saldo = $saldo.' (Trimestre en curso)';
				}
				$saldo = $entrada-$salida;
				echo '<tr>';
				echo '<td>'.$m['Inventariomaterial']['trimestre'].'</td>';
				echo '<td>'.$saldo_inicial.'</td>';
				echo '<td>'.$entrada.'</td>';
				echo '<td>'.$salida.'</td>';
				echo '<td>'.$saldo.'</td>';
				echo '<td>'.$this->Html->link('Consultar',array('action' => 'admin_consultar_movimientos',$entradas[0]['Materiasprima']['descripcion'],$m['Inventariomaterial']['trimestre'],$ano)).'</td>';
				echo '</tr>';
			}
			echo '</table>';
		} else {
			echo 'No hay movimientos registrados';
		}
	} else {
		echo 'Escoge una materia prima para observar sus movimientos';
	}
?>
</div>
