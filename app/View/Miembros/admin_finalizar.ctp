<div class="wrap">
<?php 
	echo $this->Form->create('Miembro');
	echo 'Comentario:';
	echo $this->Form->input('comentario_retiro',array(
		'label' => false
	));
	echo $this->Form->input('id',array(
		'label' => false,
		'type' => 'hidden',
		'value' => $id
	));
	echo $this->Form->submit('Retirar',array('class' => 'button'));
?>
</div>