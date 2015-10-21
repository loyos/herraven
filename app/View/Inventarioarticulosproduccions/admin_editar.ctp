<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));
?>
<h1>Salida de Artículos</h1>
<?php 
	echo $this->Form->create('Inventarioarticulosproduccion');
	echo '<table>';
	echo '<tr>';
	echo '<td>Artículo</td>';
	echo '<td>';
	echo $this->Form->input('articulosproduccion_id',array(
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
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>
