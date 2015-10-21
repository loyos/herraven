<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo?></h1>
<?php 
	echo $this->Form->create('Bano', array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('nombre',array(
			'label' => false,
		));
	echo '</td>';
	echo '<td>Descripción</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false,
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Linea</td>';
	echo '<td>';
	echo $this->Form->input('lineasgalvanica_id',array(
		'label' => false
	));
	echo '</td>';
	echo '<td><td>';
	echo '</tr>';
	echo '</table>';
	echo '<table>';
	echo '<h2>Tiempo Estimado</h2>';
	echo '<tr>';
	echo '<td>Horas</td>';
	echo '<td>';
	echo $this->Form->input('horas',array(
		'label' => false,
		'class' => 'input_pequeno'
	));
	echo '</td>';
	echo '<td>Minutos</td>';
	echo '<td>';
	echo $this->Form->input('minutos',array(
		'label' => false,
		'class' => 'input_pequeno'
	));
	echo '</td>';
	echo '<td>Segundos</td>';
	echo '<td>';
	echo $this->Form->input('segundos',array(
		'label' => false,
		'class' => 'input_pequeno'
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h2>Materias Primas asociadas</h2>';
	echo '<table>';
	for ($i=1;$i<=15;$i++) {
		if (($i-1)%4 == 0 || $i==1) {
			echo '<tr>';
		}
		echo '<td>';
		if (!empty($materiasasociadadas[$i-1]['BanosMateriasprimasgalvanica']['materiasprimasgalvanica_id'])) {
			$value = $materiasasociadadas[$i-1]['BanosMateriasprimasgalvanica']['materiasprimasgalvanica_id'];
		} else {
			$value = 0;
		}
		echo $this->Form->input('materiasprimasgalvanica.id',array(
			'label' => false,
			'name' => 'materiasgalvanicas[]',
			'type' => 'select',
			'options' => $materiasprimasgalvanicas,
			'value' => $value
		));
		echo '</td>';
		if ($i%4 == 0 || $i==15) {
			echo '</tr>';
		}
	}
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	if (!empty($this->data['Articulosproduccion']['imagen'])) {
		echo $this->Form->input('imagen',array('type'=>'hidden'));
	}
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
	
?>