<div class="wrap">

<?php 
	echo '<div class = "search">';
		echo $this->Form->create('Inventariomaterial');
		if (!empty($id_m)) {
			$value = $id_m;
		} else {
			$value = 0;
		}
		echo $this->Form->input('materiasprima_id',array(
			'value' => $value
		));
		echo $this->Form->submit('Buscar',array('class' => 'boton_busqueda'));
		echo $this->Form->end();
	echo '</div>';
	
	echo '<h1>Movimientos de Materia Prima</h1>';
	if (!empty($id_m)) {
		if (!empty($entradas)){
		?>
			<div class="subtitulo_movimientos">
			<h2>Movimientos de <?php echo $materia ?></h2>
			</div>
			<div class="ano_movimientos">
				<table>
					<tr>
						<td><?php echo $this->Html->link('Ver reporte',array('action' => 'admin_reporte_movimientos',$id_m,'ext' => 'pdf'),array('target'=>'_blank','class'=> 'boton_accion'));?></td><td><b><u>Año</u></b></td><td><b><u>Unidad</b></u></td>
					</tr>
					<tr>
						<td></td>
						<td style="text-align:center"><?php echo $ano?> </td>
						<td style="text-align:center"><?php echo $unidad ?></td>
						
					</tr>
				</table>
			</div>
			<?php
			echo $this->element('admin_movimientos');
		} else {
			echo 'No hay movimientos registrados a esta materia prima';
		}
	} else {
		echo 'Escoge una materia prima para observar sus movimientos';
	}
?>
</div>
