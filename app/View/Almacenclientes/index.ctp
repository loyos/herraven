<div class="wrap">
<h1>Inventario Almacén</h1>
<?php 
	if (!empty($articulos) && !empty($entradas_articulo)) {
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
				if (!empty($a[0]['SUM(`Almacencliente`.`cajas`)'])) {
					$entrada = $a[0]['SUM(`Almacencliente`.`cajas`)'];
				} else {
					$entrada = 0;
				}
				$salida = 0;
				if (!empty($salidas_articulo[$key])) {
					foreach ($salidas_articulo[$key] as $s) {
						if ($s['Almacencliente']['acabado_id'] == $a['Almacencliente']['acabado_id']){
							if (!empty($s[0]['SUM(`Almacencliente`.`cajas`)'])){
								$salida =  $s[0]['SUM(`Almacencliente`.`cajas`)'];
							}
						}			
					}
				}
				$saldo = $entrada -$salida;
				echo '<tr>';
				echo '<td>'.$key.'</td>';
				if (empty($a['Acabado']['acabado'])){
					$a['Acabado']['acabado'] = 'Sin Acabado';
				}
				echo '<td>'.$a['Acabado']['acabado'].'</td>';
				echo '<td>'.$entrada.'</td>';
				echo '<td>'.$salida.'</td>';
				echo '<td>'.$saldo.'</td>';
				echo '<td>'.$saldo*$articulos[$a['Almacencliente']['articulo_id']].'</td>';
				echo '<td>'.$this->Html->link('Egreso',array('action' => 'egreso',$a['Almacencliente']['articulo_id'],$a['Almacencliente']['acabado_id'],$cat_id,$sub_id),array('class'=>'boton_accion')).'</td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	} else {
		echo 'No hay articulos en el almacén';
	}
?>
</div>