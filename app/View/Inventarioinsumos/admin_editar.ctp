<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
if ($tipo == 'entrada') {
	$titulo = 'Ingreso de Insumos';
} else {
	$titulo = 'Egreso de Insumos';
}
?>
<h1><?php echo $titulo ?></h1>
<?php 
	echo $this->Form->create('Inventarioinsumo');
	echo '<table>';
	echo '<tr>';
	echo '<td>Insumo</td>';
	echo '<td>';
	echo $this->Form->input('insumo_id',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Cantidad</td>';
	echo '<td>';
	echo $this->Form->input('cantidad',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->input('tipo',array(
		'label' => false,
		'value' => $tipo,
		'type' => 'hidden'
	));
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
