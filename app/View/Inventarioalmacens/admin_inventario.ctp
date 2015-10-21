<div class="wrap">
<h1>Inventario Almacén</h1>
<?php 
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Articulo</th>
		<th>Acabado</th>
		<th>Total entradas (cajas)</th>
		<th>Total salidas (cajas)</th>
		<th>Saldo</th>
		<th>Saldo Pz.</th>
		<th>Cajas</th>
		</tr>
		<?php
		foreach($entradas_articulo as $key => $articulo) {
			foreach ($articulo as $a){
				if (!empty($a[0]['SUM(`Inventarioalmacen`.`cajas`)'])) {
					$entrada = $a[0]['SUM(`Inventarioalmacen`.`cajas`)'];
				} else {
					$entrada = 0;
				}
				$salida = 0;
				if (!empty($salidas_articulo[$key])) {
					foreach ($salidas_articulo[$key] as $s) {
						if ($s['Inventarioalmacen']['acabado_id'] == $a['Inventarioalmacen']['acabado_id']){
							if (!empty($s[0]['SUM(`Inventarioalmacen`.`cajas`)'])){
								$salida =  $s[0]['SUM(`Inventarioalmacen`.`cajas`)'];
							}
						}			
					}
				}
				$saldo = $entrada -$salida;
				echo '<tr>';
				echo '<td>'.$key.'</td>';
				if (!empty($a['Acabado']['acabado'])) {
					$val = $a['Acabado']['acabado'];
				} else {
					$val = 'Sin Acabado';
				}
				echo '<td>'.$val.'</td>';
				echo '<td>'.$entrada.'</td>';
				echo '<td>'.$salida.'</td>';
				echo '<td>'.$saldo.'</td>';
				echo '<td>'.$saldo*$articulos[$a['Inventarioalmacen']['articulo_id']].'</td>';
				if ($saldo > 0) {
					echo '<td>'.$this->Html->link('Consultar',array('action' => 'admin_consultar_cajas',$a['Inventarioalmacen']['articulo_id'],$a['Inventarioalmacen']['acabado_id'],$saldo,$cat_id,$sub_id), array('class' => 'boton_accion')).'</td>';
				} else {
					echo '<td></td>';
				}
				echo '</tr>';
			}
		}
		echo '</table>';
	}
?>
</div>