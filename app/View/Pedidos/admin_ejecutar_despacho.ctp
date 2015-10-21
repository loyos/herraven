<div class="wrap">
	<b><?php echo $pedido['Articulo']['codigo'].' '.$pedido['Acabado']['acabado']?></b>
	<br><br>
	<?php 
	echo 'Fecha: '.$pedido['Pedido']['fecha'];
	echo '<br>';
	echo 'Cliente: '.$pedido['Cliente']['denominacion_legal'];
	echo '<br>';
	echo 'Nº de pedido: '.$pedido['Pedido']['id'];
	echo '<br>';
	echo 'Nº de cajas: '.$pedido['Pedido']['cantidad_cajas'];
	echo '<br>';
	echo 'Nº de piezas: '.$pedido['Pedido']['cantidad_cajas']*$pedido['Articulo']['cantidad_por_caja'];
	echo '<br><br>';
	echo $this->Form->create('Pedido');
	echo $this->Form->input('id',array('type' => 'hidden','value' => $id));
	echo $this->Form->input('factura');
	echo '<br><br>';
	echo $this->Form->submit('Despachar', array('class' => 'button'));
	echo $this->Form->end;
	?>
</div>