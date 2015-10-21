<div class="wrap">
	<?php
	echo $this->Html->link('Imprimir',array_merge($this->params['pass'], array('print')), array('target' => uniqid(), 'class' => 'print'));
	foreach ($cajas as $a) {
		echo '<div class="etiqueta">';
		echo '<div class="codigo_caja">';
		echo $a['Caja']['codigo'];
		echo '</div>';
		echo 'Fecha de ingreso: '.$a['Inventarioalmacen']['fecha'];
		echo '<br>';
		echo 'Código de articulo: '.$a['Inventarioalmacen']['Articulo']['codigo'];
		echo '<br>';
		echo 'Cantidad de articulos: '.$a['Inventarioalmacen']['Articulo']['cantidad_por_caja'];
		echo '<br>';
		echo '</div>';
	}
	?>
</div>