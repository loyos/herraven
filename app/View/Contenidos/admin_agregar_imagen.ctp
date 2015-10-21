<div class="wrap">
<?php
echo $this->Html->link('Regresar',array('action' => 'admin_home'),array('class'=>'boton'));
?>
<?php
	echo '<h1>Agregar nueva imagen</h1>';
	echo $this->Form->create('Contenido', array('type' => 'file'));
	echo $this->Form->file('Imagen.Foto',array(
		'label' => 'Imagen'
	));
	echo $this->Form->submit('Agregar', array('class' => 'button'));
	echo $this->Form->end;
?>
</div>