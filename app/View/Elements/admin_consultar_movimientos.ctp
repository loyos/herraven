<h3>Entradas</h3>
	<?php
	if (!empty($entradas)) {
		?>
		<table>
			<tr>
				<th>Fecha</th>
				<th>Cantidad</th>
			</tr>
		<?php
		foreach ($entradas as $e) {
		?>
			<tr>
				<?php 
				$date = date_create($e['Inventariomaterial']['fecha']);
				?>
				<td style= "padding-right: 40px;"><?php echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo number_format($e['Inventariomaterial']['cantidad'], 2, ',', '.'); ?></td>
			</tr>
		<?php
		}
		?>
		</table>
		<?php
	} else {
		echo 'No hay entradas registradas';
	}
	?>
	<h3>Salidas</h3>
	<?php
	if (!empty($salidas)) {
		?>
		<table>
			<tr>
				<th>Semana</th>
				<th>Cantidad</th>
			</tr>
		<?php
		foreach ($salidas as $s) {
		?>
			<tr>
				<?php
					if ($s['Inventariomaterial']['semana'] == 1){
						$dias = 'del 1 al 7 del mes '.$s['Inventariomaterial']['mes'];
					} elseif ($s['Inventariomaterial']['semana'] == 2){
						$dias = 'del 8 al 15 del mes '.$s['Inventariomaterial']['mes'];
					} elseif ($s['Inventariomaterial']['semana'] == 3){
						$dias = 'del 16 al 22 del mes '.$s['Inventariomaterial']['mes'];
					} elseif ($s['Inventariomaterial']['semana'] == 4){
						$dias = 'del 23 al 30 del mes '.$s['Inventariomaterial']['mes'];
					}
				?>
				<td  style= "padding-right: 40px;"><?php echo $dias ?></td>
				<td><?php echo number_format($s[0]['SUM(`Inventariomaterial`.`cantidad`)'], 2, ',', '.'); ?></td>
			</tr>
		<?php
		}
		?>
		</table>
		<?php
	} else {
		echo 'No hay salidas registradas';
	}
	?>