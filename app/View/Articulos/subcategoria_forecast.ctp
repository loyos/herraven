<div class="wrap">
<?php
foreach ($categorias as $cat) {
	echo '<div class="listado_categoria">';
	echo $cat['Categoria']['descripcion'];
		// echo $this->Html->link($cat['Categoria']['descripcion'], array('action' => 'admin_forecast',$cat['Categoria']['id']));
	echo '</div>';
	echo '<br>';
	echo '<div class="listado_subcategoria">';
	foreach ($cat['Subcategoria'] as $sub) {	
		echo $this->Html->link($sub['descripcion'], array('action' => 'admin_forecast',$cat['Categoria']['id'],$sub['id']));
		echo '<br>';
	}
	echo '</div>';
	echo '<br>';
}

?>

</div>