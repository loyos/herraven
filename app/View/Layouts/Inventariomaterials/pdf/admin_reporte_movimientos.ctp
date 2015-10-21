<div style="margin-left:500px">
	<table>
		<tr>
			<th  style="border-bottom:1px solid black">Materia prima</th>
			<th  style="border-bottom:1px solid black">Año</th>
			<th  style="border-bottom:1px solid black">Unidad</th>
		</tr>
		<tr>
			<td><?php echo $materia_prima['Materiasprima']['descripcion']?></td>
			<td><?php echo $ano?></td>
			<td><?php echo $materia_prima['Materiasprima']['unidad']?></td>
		</tr>
	</table>
	<?php
echo '</div>';
echo '<h2>Reporte de movimientos</h2>';
$aux = 0;
foreach($trimestres as $m){
	if (!empty($entradas[$m['Inventariomaterial']['trimestre']]) || !empty($salidas[$m['Inventariomaterial']['trimestre']])) {
		if (!empty($saldo_e[$m['Inventariomaterial']['trimestre']-1])) {
			if (empty($saldo_s[$m['Inventariomaterial']['trimestre']-1])) {
				$saldo_s[$m['Inventariomaterial']['trimestre']-1]= 0;
			} 
			$saldo_inicial = $saldo_e[$m['Inventariomaterial']['trimestre']-1]-$saldo_s[$m['Inventariomaterial']['trimestre']-1];
			$saldo_inicial = number_format($saldo_inicial,2,',','.');
		} else {
			$saldo_inicial = 'Sin registrar';
		}
		?>
		<table>
			<tr>
				<th style="border-bottom:1px solid black">Trimestre</th>
				<th style="border-bottom:1px solid black">Saldo incial</th>
				<th style="border-bottom:1px solid black">Total entradas</th>
				<th style="border-bottom:1px solid black">Total salidas</th>
				<th style="border-bottom:1px solid black">Saldo al cierre</th>
			</tr>
			<tr>
				<td><?php echo $m['Inventariomaterial']['trimestre'];
					if ($m['Inventariomaterial']['trimestre'] == $trimestre_actual) {
						echo ' (Trimestre en curso)';
					}
				?>
				</td>
				<td><?php echo $saldo_inicial?></td>
				<td><?php echo number_format($saldo_e[$m['Inventariomaterial']['trimestre']],2,',','.');?></td>
				<td><?php echo number_format($saldo_s[$m['Inventariomaterial']['trimestre']],2,',','.');?></td>
				<td><?php echo number_format($saldo_e[$m['Inventariomaterial']['trimestre']]-$saldo_s[$m['Inventariomaterial']['trimestre']],2,',','.');?> </td>
			</tr>
		</table>
		<br>
		<?php
		echo $this->element('admin_reporte_movimientos',array(
			'entradas' => $entradas[$m['Inventariomaterial']['trimestre']],
			'salidas' => $salidas[$m['Inventariomaterial']['trimestre']]
		));
		echo '<br>';
	} 
	$aux++;
}
?>