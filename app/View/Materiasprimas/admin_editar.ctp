<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('controller' => 'inventariomaterials','action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Materiasprima');
	echo '<table>';
	echo '<tr>';
	echo '<td>Materia prima</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Unidad</td>';
	echo '<td>';
	echo $this->Form->input('unidad',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Precio en lista base</td>';
	echo '<td>';
	if (empty($precio_b)) {
		$precio_b = null;
	}
	echo $this->Form->input('precio',array(
		'label' => false,
		'value' => $precio_b
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
