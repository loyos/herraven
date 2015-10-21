<div class="wrap">
	<?php
	echo '<h3>Cajas</h3>';
	echo $this->Form->create('Pedido');
	for ($i = 1; $i<=$cantidad; $i++) {
	echo $this->Form->input('codigo',array(
		'name' => 'codigo[]',
		'class' => 'codigos_cajas'
	));
	$a = $i-1;
	echo '<div class="mensaje_error['.$a.']">';
	echo '</div>';
	}
	echo $this->Form->submit('Asignar',array('class' => 'button','onclick' => 'validar()'),array('onclick' => 'validar'));
	//echo $this->Form->end();
	?>
	
</div>
<script>
	// function validar(){
		// input = $('.codigos_cajas');
		// $.each(input, function(index, value) {
			// valor = $(value).val();
			// if (valor == "") {
				// alert('mensaje_error['+index+']');
				// $('.mensaje_error['+index+']').val('dfd');
			// }
		// });
		// return false;
	// }
</script>