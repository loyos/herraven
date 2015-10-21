<div class="wrap">
	<div class="info1_derecha">
		<table style="margin-left: 179px;">
			<tr><th style="border-bottom: 2px solid black;">Año</th></tr>
			<tr><td><?php echo $ano ?></td></tr>
		</table>
		<br>
		<div class="busqueda_nomina">
		<?php
		echo $this->Form->create();
		echo '<table>';
			echo '<tr>';
				echo '<td>Año</td>';
				echo '<td>'.$this->Form->input('Dia.ano1',array(
					'label' => false,
				));
			echo '</td></tr>';
			echo '<tr>';
				echo '<td>Número</td>';
				echo '<td>'.$this->Form->input('Dia.numero',array(
					'label' => false,
				));
			echo '</td></tr>';
		echo '</table>';
		echo $this->Form->submit('Buscar',array('class' => 'boton_busqueda'));
		?>
		</div>
	</div>
	<h2>Nómina</h2>
	<?php
	if (!empty($semanas)) { ?>
	<table class="tabla_index">
		<tr>
			<th>Nº</th>
			<th>Semana</th>
			<th></th>
		</tr>
		<?php foreach ($semanas as $k=>$s) { ?>
			<tr>
				<td><?php echo $k ?></td>
				<td><?php echo $s ?></td>
				<td><?php echo $this->Html->link('Ver Reporte',array(
					'action' => 'admin_ver_reporte',$k,$ano,'ext' => 'pdf'
					),
					array('class' => 'boton_accion')
				); ?>
				</td>
			</tr>
		<?php } ?>
	</table>
	<?php
	} else {
		echo 'No se encontraron resultados';
	}
	
	?>
</div>