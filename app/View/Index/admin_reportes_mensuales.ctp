<div class="wrap">
	<table class= "tabla_index">
		<tr>
			<th>Estadística</th>
			<th><?php echo $nombre_mes_antepasado?></th>
			<th><?php echo $nombre_mes_pasado?></th>
			<th><?php echo $nombre_mes?></th>
			<th></th>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Puntos en Producción',array('action' => 'admin_puntos_produccion_mensual'))?></td>
			<td><?php echo $puntos_produccion_antepasado?></td>
			<td><?php echo $puntos_produccion_pasado?></td>
			<td><?php echo $puntos_produccion_actual?></td>
			<?php if ($puntos_produccion == 'menor') {
				$val = 'flecha_roja.PNG';
			} else {
				$val = 'flecha_verde.PNG';
			} ?>
			<td><?php echo $this->Html->image($val,array('width' => '20px'));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Puntos en Ventas',array('action' => 'admin_puntos_ventas_mensual'))?></td>
			<td><?php echo $puntos_ventas_antepasadas?></td>
			<td><?php echo $puntos_ventas_pasadas?></td>
			<td><?php echo $puntos_ventas_actuales?></td>
			<?php if ($puntos_ventas == 'menor') {
				$val = 'flecha_roja.PNG';
			} else {
				$val = 'flecha_verde.PNG';
			} ?>
			<td><?php echo $this->Html->image($val,array('width' => '20px'));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Facturación',array('action' => 'admin_facturacion_mensual'))?></td>
			<td><?php echo $facturaciones_antepasadas?></td>
			<td><?php echo $facturaciones_pasadas?></td>
			<td><?php echo $facturaciones_actuales?></td>
			<?php if ($facturacion == 'menor') {
				$val = 'flecha_roja.PNG';
			} else {
				$val = 'flecha_verde.PNG';
			} ?>
			<td><?php echo $this->Html->image($val,array('width' => '20px'));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Cuentas por cobrar',array('action' => 'admin_cuentas_mensual'))?></td>
			<td><?php echo $sum_cuentas_no_pagadas_antepasadas?></td>
			<td><?php echo $sum_cuentas_no_pagadas_pasadas?></td>
			<td><?php echo $sum_cuentas_no_pagadas?></td>
			<?php if ($sum_cuentas == 'menor') {
				$val = 'flecha_roja.PNG';
			} else {
				$val = 'flecha_verde.PNG';
			} ?>
			<td><?php echo $this->Html->image($val,array('width' => '20px'));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Cobranza',array('action' => 'admin_cobranza_mensual'))?></td>
			<td><?php echo $abonos_antepasados?></td>
			<td><?php echo $abonos_pasados?></td>
			<td><?php echo $abonos_actuales?></td>
			<?php if ($cobranza == 'menor') {
				$val = 'flecha_roja.PNG';
			} else {
				$val = 'flecha_verde.PNG';
			} ?>
			<td><?php echo $this->Html->image($val,array('width' => '20px'));?></td>
		</tr>
	</table>
</div>