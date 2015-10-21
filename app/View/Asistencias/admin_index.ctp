<div class="wrap">
	<?php 	echo $this->Form->create('Asistencia'); ?>
	<h2>Control de Asistencias</h2>
	<div class="info1_derecha">
	<span class="subtitulo">
	<?php echo 'Semana '.$fecha_semana.' del '.$ano ?>
	</span>
	</div>
	<span class="subtitulo">
	<?php echo $dia.' '.$fecha?>
	</span>
	<?php
	echo $this->Form->input('Dia.laborable',array(
		'label' => 'Es laborable?',
		'type' => 'checkbox',
		'checked' => $es_laborable	
	));
	?>
	<br>
	<?php
	echo $this->Form->submit('Cerrar día',array('onclick' => 'activa_cerrar()','class' => 'button'));
	echo $this->Form->input('cerro_dia',array(
		'label' =>false,
		'type' => 'hidden',
		'value' => 0,
		'id' => 'cerro'
	));
	echo '<br>';
	if (!empty($miembros)) { ?>
		<table class="tabla_index_sin_width" width="100%">
			<tr>
				<th>Nº</th>
				<th>Personal</th>
				<th>Asistencia</th>
				<th>Observacion</th>
			</tr>
			<?php 
			$count = 1;
			foreach ($miembros as $m) {
			?>
				<tr>
					<td style="text-align:left"><?php echo $count?></td>
					<?php $nombre = "";
					if (!empty($m['User']['nombre'])) {
						$nombre = $m['User']['nombre'].' ';
					}
					if (!empty($m['User']['apellido'])) {
						$nombre = $nombre.$m['User']['apellido'].' ';
					}
					?>
					<td style="text-align:left"><?php echo $nombre?></td>
					<td><?php
					if (!empty($asistencias[$m['Miembro']['id']]) && $asistencias[$m['Miembro']['id']] == 1) {
						$checked = true;
					} else {
						$checked = false;
					}
					echo $this->Form->input('asist',array(
						'label' => false,
						'type' => 'checkbox',
						'name' => 'asistencia['.$m['Miembro']['id'].']',
						'checked' => $checked
					));
					?>
					</td>
					<td>
					<?php
					if (!empty($observaciones[$m['Miembro']['id']])) {
						$value = $observaciones[$m['Miembro']['id']];
					} else {
						$value = '';
					}
					echo $this->Form->input('observacion',array(
						'label' => false,
						'type' => 'text',
						'name' => 'observacion['.$m['Miembro']['id'].']',
						'value' => $value,
						'style' => 'width:350px'
					));
					?>
					</td>
				</tr>
			<?php
				$count++;
			}
			?>
		</table>
	<?php
	} 
	echo $this->Form->submit('Guardar Cambios',array('class'=>'button'));
	?>
</div>
<script>
	function activa_cerrar(){
		$('#cerro').val(1);
	}
</script>