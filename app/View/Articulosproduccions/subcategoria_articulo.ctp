<div class="wrap">
<?php
foreach ($categorias as $cat) {
	echo '<div class="listado_categoria">';
	echo $cat['Lineasminumet']['descripcion'];
		// echo $this->Html->link($cat['Categoria']['descripcion'], array('action' => 'admin_index',$cat['Categoria']['id']));
	echo '</div>';
	echo '<br>';
	echo '<div class="listado_subcategoria">';
	foreach ($cat['Subcategoriaminumet'] as $sub) {	
		echo $this->Html->link($sub['descripcion'], array('action' => 'admin_index',$cat['Lineasminumet']['id'],$sub['id']));
		echo '<br>';
	}
	echo '</div>';
	echo '<br>';
}

?>

</div>