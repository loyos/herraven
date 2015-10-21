<div class="wrap">

<?php 
	echo '<div class = "search">';
		echo $this->Form->create('Inventarioinsumo');
		if (!empty($id_m)) {
			$value = $id_m;
		} else {
			$value = 0;
		}
		echo $this->Form->input('insumo_id',array(
			'value' => $value
		));
		echo $this->Form->input('lote_id',array(
			'value' => $lote_id,
			'type' => 'hidden'
		));
		echo $this->Form->submit('Buscar',array('class' => 'boton_busqueda'));
		echo $this->Form->end();
	echo '</div>';
	
	echo '<h1>Movimientos de Insumo</h1>';
	if (!empty($id_m)) {
		if (!empty($entradas)){
		?>
			<div class="subtitulo_movimientos">
			<h2>Movimientos de <?php echo $nombre ?></h2>
			</div>
			<?php
			echo $this->element('admin_movimientos_insumos');
		} else {
			echo 'No hay movimientos registrados a este insumo';
		}
	} else {
		echo 'Escoge un insumo para observar sus movimientos';
	}
?>
</div>
