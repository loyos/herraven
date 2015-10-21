<div class="wrap">
<h1>Clientes</h1>
<?php
foreach ($clientes as $c) {
	echo '<div class="listado_categoria">';
		echo $this->Html->link($c['Cliente']['denominacion_legal'], array('action' => $action,'admin_index',$c['Cliente']['id']));
	echo '</div>';
	echo '<br>';
}

?>

</div>