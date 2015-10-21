<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar',$cat_id,null,$sub_id),array('class'=>'boton'));
?>
<h1>Artículos</h1>
<?php 
echo '<b>Linea</b>: '.$linea['Categoria']['descripcion'].'<br>';
if (!empty($subcategoria['Subcategoria']['descripcion'])){
	echo '<b>Categoria</b>: '.$subcategoria['Subcategoria']['descripcion'].'<br>';
}
echo '<br>';
	if (!empty($articulos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Código</th>
		<th>Linea</th>
		<th>Categoria</th>
		<th>Descripción</th>
		<th>Puntos</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($articulos as $c) {
			echo '<tr>';
			echo '<td>'.$c['Articulo']['codigo'].'</td>';
			echo '<td>'.$c['Subcategoria']['Categoria']['descripcion'].'</td>';
			echo '<td>'.$c['Subcategoria']['descripcion'].'</td>';
			echo '<td>'.$c['Articulo']['descripcion'].'</td>';
			echo '<td>'.$c['Articulo']['puntos'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array('action' => 'admin_editar',$cat_id,$c['Articulo']['id'],$sub_id),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Articulo']['id'],$cat_id,$sub_id),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'<br>'.$this->Html->link('Ver',array('action' => 'admin_ver',$c['Articulo']['id'],$cat_id,$sub_id),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>
