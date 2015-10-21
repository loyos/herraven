<div class="wrap">
	<?php
	echo '<h3>'.$articulo['Articulo']['codigo'].' '.$articulo['Articulo']['cantidad_por_caja'].' pz</h3>';
	echo $this->Form->create('Inventarioalmacen');
	echo $this->Form->input('cajas');
	echo $this->Form->input('acabado_id');
	echo $this->Form->submit('Ingresar', array('class' => 'button'));
	echo $this->Form->end;
	?>
</div>