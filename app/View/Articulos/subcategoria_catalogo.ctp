<div class="wrap">
<?php
foreach ($categorias as $cat) {
	echo '<div class="listado_categoria">';
		echo $cat['Categoria']['descripcion'];
	echo '</div>';
	echo '<br>';
	echo '<div class="listado_subcategoria">';
	foreach ($cat['Subcategoria'] as $sub) {	
		echo $this->Html->link($sub['descripcion'], array('action' => 'catalogo',$sub['id'],$tipo));
		echo '<br>';
	}
	echo '</div>';
	echo '<br>';
}

?>

</div>