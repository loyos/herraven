<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Division',array('type' => 'file'));
	echo '<table>';
	echo '<tr>';
	echo '<td>Número</td>';
	echo '<td>';
	echo $this->Form->input('numero',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('nombre',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Jefe de la división</td>';
	echo '<td>';
	echo $this->Form->input('user_id',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Descripcion</td>';
	echo '<td>';
	echo $this->Form->input('descripcion',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<h3>Departamentos</h3>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo '<table class="tabla_index">';
	echo '<tr>';
	echo '<th>Departamento 1</th>';
	echo '<th>Departamento 2</th>';
	echo '<th>Departamento 3</th>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>';
	echo $this->Form->input('departamento_id',array(
		'value' => $departamento1,
		'name' => 'departamento1',
		'label' => false
	));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('departamento_id',array(
		'value' => $departamento2,
		'name' => 'departamento2',
		'label' => false
	));
	echo '</td>';
	echo '<td>';
	echo $this->Form->input('departamento_id',array(
		'value' => $departamento3,
		'name' => 'departamento3',
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>