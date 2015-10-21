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
				$date = date_create($e['Inventarioinsumo']['fecha']);
				?>
				<td style= "padding-right: 40px;"><?php echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo number_format($e['Inventarioinsumo']['cantidad'], 2, ',', '.'); ?></td>
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
				<th>Fecha</th>
				<th>Cantidad</th>
			</tr>
		<?php
		foreach ($salidas as $s) {
		?>
			<tr>
				<?php 
				$date = date_create($s['Inventarioinsumo']['fecha']);
				?>
				<td style= "padding-right: 40px;"><?php echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo number_format($s['Inventarioinsumo']['cantidad'], 2, ',', '.'); ?></td>
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