<div class="wrap">
<?php echo $this->Html->link('Regresar',array('action' => 'admin_index'),array('class'=>'boton'));?>
<h1><?php echo $titulo?></h1>
<?php 
	echo $this->Form->create('Rol');
	echo '<table>';
	echo '<tr>';
	echo '<td>Nombre</td>';
	echo '<td>';
	echo $this->Form->input('nombre',array(
			'label' => false,
		));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	if (!empty($id)) {
		echo $this->Form->input('id',array('type'=>'hidden'));
	}
	echo $this->Form->submit('Guardar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>