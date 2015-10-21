<div class="wrap">
	<?php
	if(!empty($asistencias)) {
		$count = 1;
		foreach ($asistencias as $a) {
		?>
		<h2>Nómina</h2>
		<table class="tabla_index" style="width:80%">
			<tr>
				<th style="border-bottom:2px solid black; padding:5px">Nº</th>
				<th style="border-bottom:2px solid black; padding:5px">Personal</th>
				<th style="border-bottom:2px solid black; padding:5px">Puesto</th>
				<th style="border-bottom:2px solid black; padding:5px">Semana</th>
				<th style="border-bottom:2px solid black; padding:5px">Ano</th>
			</tr>
			<tr>
				<td style="text-align:center"><?php echo $count ?></td>
				<td style="text-align:center"><?php echo $a['nombre'] ?></td>
				<td style="text-align:center"><?php echo $a['puesto'] ?></td>
				<td style="text-align:center"><?php echo $fecha_semana ?></td>
				<td style="text-align:center"><?php echo $ano ?></td>
			</tr>
		</table>
		<br>
	
		<table class="tabla_index" style="width:100%">
			<tr>
				<th style="border-bottom:2px solid black; padding:5px">Fecha</th>
				<th style="border-bottom:2px solid black; padding:5px">Dia</th>
				<th style="border-bottom:2px solid black; padding:5px">Laborable</th>
				<th style="border-bottom:2px solid black; padding:5px">Asistió</th>
				<th style="border-bottom:2px solid black; padding:5px">Observaciones</th>
			</tr>
			<?php foreach($a['asistencia'] as $as) { ?>
			<tr>
				<?php 
				$date = date_create($as['Dia']['fecha']);
				$d = date_format($date, 'd/m'); ?>
				<td style="text-align:center"><?php echo $d ?></td>
				<td style="text-align:center"><?php echo $this->Herra->nombreDia($as['Dia']['fecha']) ?></td>
				<?php if($as['Dia']['laborable'] == 1) {
					$l = 'Si';
				} else {
					$l = 'No';
				} ?>
				<td style="text-align:center"><?php echo $l ?></td>
				<?php if($as['Asistencia']['asistio'] == 1) {
					$l = 'Si';
				} else {
					$l = 'No';
				} ?>
				<td style="text-align:center"><?php echo $l ?></td>
				<td style="text-align:center"><?php echo $as['Asistencia']['observacion'] ?></td>
			</tr>
			<?php } ?>
		</table>
		<hr style="background-color: black; width:100%; height:2px; margin-top:5px;" />
		<br><br><br>
		<hr align="right" style="background-color: black; width:20%; size:1; margin-top:5px;" />
		<?php echo $a['nombre'];
		echo '<h1 style="page-break-after:always;" />';
		$count++;
		}
	} else{
		echo 'No hay información';
	}?>
</div>