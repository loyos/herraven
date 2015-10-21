<div class="wrap">
	<?php echo $this->Html->link('Agregar herramienta',array('action'=>'admin_editar'),array('class'=>'boton'));?>

	<h2>Escoge un Lote</h2>
	<?php
	foreach ($lotes as $l) {
		echo '<div class="listado_categoria">';
		echo $this->Html->link($l['Lotesherramienta']['nombre'], array('action' => 'admin_index',$l['Lotesherramienta']['id']));
		echo '</div>';
	}
	?>
</div>