<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Categorias Minumet</h1>
<?php 
	if (!empty($subcategorias)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Oculto</th>
		<th>Linea</th>
		<th>Categoria</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($subcategorias as $c) {
			echo '<tr>';
			echo '<td>';
			if ($c['Subcategoriaminumet']['oculto'] == 1){
				$value = 'Si';
			} else {
				$value = 'No';
			}
			echo $value;
			echo '</td>';
			echo '<td>'.$c['Lineasminumet']['descripcion'].'</td>';
			echo '<td>'.$c['Subcategoriaminumet']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$c['Subcategoriaminumet']['id']),array('class'=>'boton_accion')).'<br>';
			if ($eliminar_cat[$c['Subcategoriaminumet']['id']] == 0){
				echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Subcategoriaminumet']['id']),
					array('class'=>'boton_accion'),
					'¿Estás seguro que deseas eliminar?').'<br>';
			}
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>

