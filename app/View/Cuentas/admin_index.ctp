<div class="wrap">
<h1>Cuentas</h1>
<?php 
	echo $this->element('search_cuentas');  // esto es para el filtro interno, no hace falta ahorita ya que se colocara filtro previo por subcategoria
	// debug($clientes);
	if (!empty($cuentas)) {
		?>
		<table class="tabla_index">
		<tr>
		<th></th>
		<th>Fecha</th>
		<th>Nº de pedido</th>
		<th>Nº de Factura</th>
		<th>Cliente</th>
		<th>Monto total</th>
		<th>Monto restante</th>
		<th>Status</th>
		</tr>
		<?php
		$cuenta = 0;
		foreach($cuentas as $c) {
			echo '<tr>';
			if ($c['Cuenta']['status'] != 'Pagado') {
				echo '<td>'.$this->Html->link('Pagar',array('action' => 'admin_pagar',$c['Cuenta']['id']),array('class'=>'boton_accion')).'</td>';
			} else {
				echo '<td></td>';
			}
			$fecha = explode(' ',$c['Cuenta']['fecha']);
			$date = date_create($fecha[0]);
			echo '<td>'.date_format($date, 'd-m-Y').'</td>';
			echo '<td>'.$c['Pedido']['num_pedido'].'</td>';
			echo '<td>'.$c['Pedido']['factura'].'</td>';
			echo '<td>'.$c['Pedido']['Cliente']['denominacion_legal'].'</td>';
			echo '<td>'.$this->Herra->format_number($c['Pedido']['cuenta']).'</td>';
			if(!empty($c['Cuenta']['deposito'])){
				$saldo = $c['Pedido']['cuenta']-$c['Cuenta']['deposito'];
			} else {
				$saldo = $c['Pedido']['cuenta'];
			}
			$cuenta = $cuenta+$saldo;
			echo '<td>'.$this->Herra->format_number($saldo).'</td>';
			echo '<td>'.$c['Cuenta']['status'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo 'No hay cuentas pendientes';
	}
	if (empty($cuenta)) $cuenta= 0;
	echo '<h3> El monto total restante es de '.$this->Herra->format_number($cuenta).'</h3>';
?>
</div>
