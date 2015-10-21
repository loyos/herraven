<div class="wrap">
	<h2>Pago</h2>
	<table>
		<tr>
			<th>Nº de factura</th>
			<th>Cliente</th>
			<th>Monto total </th>
			<th>Monto restante</th>
		</tr>
		<tr>	
			<td><?php echo $cuenta_a_pagar['Pedido']['factura'] ?></td>
			<td><?php echo $cuenta_a_pagar['Pedido']['Cliente']['denominacion_legal'] ?></td>
			<td><?php echo $cuenta_a_pagar['Pedido']['cuenta'] ?></td>
			<td><?php echo $cuenta_a_pagar['Pedido']['cuenta']-$cuenta_a_pagar['Cuenta']['deposito']?></td>
		</tr>
	</table>
	<br>
	<?php
	echo $this->Form->create('Cuenta');
	echo $this->Form->input('monto',array(
		'label' => 'Monto a pagar'
	));
	echo $this->Form->input('id',array(
		'type' => 'hidden',
		'value' => $id
	));
	echo $this->Form->submit('Pagar',array('class' => 'button'));
	echo $this->Form->end();
	?>
</div>