<div class="wrap">
	<table class= "tabla_index">
		<tr>
			<th>Estadística</th>
			<th><?php echo $semana_antepasada?></th>
			<th><?php echo $semana_pasada?></th>
			<th><?php echo $semana?></th>
			<th></th>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Puntos en Producción',array('action' => 'admin_puntos_produccion_semanal'))?></td>
			<td><?php echo $puntos_produccion_antepasados?></td>
			<td><?php echo $puntos_produccion_pasados?></td>
			<td><?php echo $puntos_produccion_actuales?></td>
			<?php if ($puntos_produccion == 'menor') {
				$val = 'flecha_roja.PNG';
			} else {
				$val = 'flecha_verde.PNG';
			} ?>
			<td><?php echo $this->Html->image($val,array('width' => '20px'));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Puntos en Ventas',array('action' => 'admin_puntos_ventas_semanal'))?></td>
			<td><?php echo $puntos_ventas_antepasados?></td>
			<td><?php echo $puntos_ventas_pasados?></td>
			<td><?php echo $puntos_ventas_actuales?></td>
			<?php if ($puntos_ventas == 'menor') {
				$val = 'flecha_roja.PNG';
			} else {
				$val = 'flecha_verde.PNG';
			} ?>
			<td><?php echo $this->Html->image($val,array('width' => '20px'));?></td>
		</tr>
		<tr>
			<td><?php echo $this->Html->link('Facturación',array('action' => 'admin_facturacion_semanal'))?></td>
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
			<td><?php echo $this->Html->link('Cuentas por cobrar',array('action' => 'admin_cuentas_semanal'))?></td>
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
			<td><?php echo $this->Html->link('Cobranza',array('action' => 'admin_cobranza_semanal'))?></td>
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