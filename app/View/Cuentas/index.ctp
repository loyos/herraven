<div class="wrap">
<h1>Cuentas</h1>
<?php 
	if (!empty($cuentas)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Fecha</th>
		<th>Nº de pedido</th>
		<th>Nº de Factura</th>
		<th>Monto total</th>
		<th>Monto abonado</th>
		<th>Monto restante</th>
		<th>Status</th>
		</tr>
		<?php
		foreach($cuentas as $c) {
			echo '<tr>';
			if(!empty($c['Cuenta']['deposito'])){
				$saldo = $c['Pedido']['cuenta']-$c['Cuenta']['deposito'];
			} else {
				$saldo = $c['Pedido']['cuenta'];
			}
			$fecha = explode(' ',$c['Cuenta']['fecha']);
			$date = date_create($fecha[0]);
			echo '<td>'.date_format($date, 'd-m-Y').'</td>';
			echo '<td>'.$c['Pedido']['num_pedido'].'</td>';
			echo '<td>'.$c['Pedido']['factura'].'</td>';
			echo '<td>'.$this->Herra->format_number($c['Pedido']['cuenta']).'</td>';
			$abono = $c['Pedido']['cuenta']-$saldo;
			echo '<td>'.$this->Herra->format_number($abono).'</td>';
			echo '<td>'.$this->Herra->format_number($saldo).'</td>';
			echo '<td>'.$c['Cuenta']['status'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo 'Usted no posee cuentas pendientes';
	}
?>
<div class = "chiclet_tabla">
	
</div>
</div>
