<div class="wrap">
	<h2><?php echo $bano['Lineasgalvanica']['nombre']?></h2>
	<h1><?php echo $bano['Bano']['nombre']?></h1>
	<h3>Insumos</h3>
	<?php if (!empty($materias)) {
		echo '<table>';
		echo $this->Form->create('Inventariomateriasgalvanica');
		foreach ($materias as $m) {
			echo '<tr>';
				echo '<td>'.$m['Materiasprimasgalvanica']['descripcion'].'</td>';
				echo '<td>';
				echo $this->Form->input('cantidad',array(
					'label' => false,
					'name' => 'materias['.$m['Materiasprimasgalvanica']['id'].']',
				));
				echo '</td>';
				echo '<td>'.$m['Materiasprimasgalvanica']['unidad'].'</td>';
			echo '</tr>';
		}
		echo $this->Form->input('Bano.id',array(
			'value' => $id,
			'type' => 'hidden',
			'label' => false
		));
		echo '</table>';
		echo $this->Form->submit('Consumir',array('class' => 'button'));
	} else {
		echo '<h3>No hay insumos asociados a este baño';
	}?>
</div>