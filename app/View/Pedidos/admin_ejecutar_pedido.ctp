<div class="wrap">
	<div class="egreso_izquierda">
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
		echo '<div class="boton_egreso">';
		echo $this->Form->create('Pedido');
		echo $this->Form->input('id',array('type' => 'hidden','value' => $id));
		echo $this->Form->submit('Egreso', array('class' => 'button'));
		echo $this->Form->end;
		echo '</div>';
		?>
	</div>
	<div class="egreso_derecha">
		<?php echo $this->Html->image('articulos/'.$pedido['Articulo']['imagen'],array(
			'width' => '130px'
		));?>
	</div>
</div>