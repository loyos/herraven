<div class="wrap">
	<h1>Insumos</h2>
	<?php
	foreach ($lotes as $l) {
		echo '<div class="listado_categoria">';
			echo $this->Html->link($l['Lote']['nombre'], array('action' => $action,$l['Lote']['id']));
		echo '</div>';
	}

?>
</div>