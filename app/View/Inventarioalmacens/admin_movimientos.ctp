<div class="wrap">
	<?php

	echo '<div class = "search">';
	echo $this->Form->create('Inventarioalmacen');
	echo '<table>';
	echo '<tr>';
	echo '<td>Articulo</td>';
	echo '<td>';
	if (!empty($this->data['Inventarioalmacen']['articulo_id'])){
		$value = $this->data['Inventarioalmacen']['articulo_id'];
	} else {
		$value = 0;
	}
	echo $this->Form->input('articulo_id',array(
		'value' => $value,
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Acabado</td>';
	echo '<td>';
	echo $this->Form->input('acabado_id',array(
		'label' => false
	));
	echo '</td>';
	echo '</tr>';

	echo '<tr>';
	echo '<td>Mes</td>';
	echo '<td>';
	echo $this->Form->input('mes',array(
		'type' => 'select',
		'options' => $meses,
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Tipo</td>';
	echo '<td>';
	echo $this->Form->input('tipo',array(
		'type' => 'select',
		'options' => $tipos	,
		'label' => false
	));
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo $this->Form->submit('Buscar',array('class'=>'boton_busqueda'));
	echo $this->Form->end();
	echo '<br>';
	echo '</div>';
		echo '<h1>Movimientos del almacén</h1>';
	if (!empty($saldo)) {
		if (!empty($this->data['Inventarioalmacen']['tipo']) && $this->data['Inventarioalmacen']['tipo'] == 'entrada') {
			echo 'Total de entradas '.$saldo;
		}
		if (!empty($this->data['Inventarioalmacen']['tipo']) && $this->data['Inventarioalmacen']['tipo'] == 'salida') {
			echo 'Total de salidas '.$saldo;
		}
		if (empty($this->data['Inventarioalmacen']['tipo'])) {
			echo 'Saldo '.$saldo;
		}
	}
	if (!empty($inventarios)){
	?>
	<table class = "tabla_index">
		<tr>
			<th>Fecha y hora</th>
			<th>Articulo</th>
			<th>Acabado</th>
			<th>Cajas</th>
			<th>Cantidad de pza</th>
			<th>Tipo</th>
		</tr>
		<?php 
		foreach ($inventarios as $i) {
			echo '<tr>';
				$date = date_create($i['Inventarioalmacen']['fecha']);
				echo '<td>'.date_format($date, 'd-m-Y H:i:s').'</td>';
				echo '<td>'.$i['Articulo']['codigo'].'</td>';
				if (empty($i['Acabado']['acabado'])) {
					$i['Acabado']['acabado'] = 'Sin Acabado';
				}
				echo '<td>'.$i['Acabado']['acabado'].'</td>';
				echo '<td>'.$i['Inventarioalmacen']['cajas'].'</td>';
				echo '<td>'.$i['Articulo']['cantidad_por_caja']*$i['Inventarioalmacen']['cajas'].'</td>';
				if ($i['Inventarioalmacen']['tipo'] == 'entrada') {
					$val = 'Ingreso';
				} else {
					$val = 'Egreso';
				}
				echo '<td>'.$val.'</td>';
			echo '</tr>';
		}
		?>
	</table>
	<?php
	} else {
		echo 'No hay movimientos registrados con estas condiciones';
	}
	?>
</div>