<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Lineas Minuteria Auxiliar</h1>
<?php 
	if (!empty($categorias)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Oculto</th>
		<th>Linea</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($categorias as $c) {
			echo '<tr>';
			echo '<td>';
			if ($c['Lineasminumet']['oculto'] == 1){
				$value = 'Si';
			} else {
				$value = 'No';
			}
			echo $value;
			echo '</td>';
			echo '<td>'.$c['Lineasminumet']['descripcion'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$c['Lineasminumet']['id']),array('class'=>'boton_accion')).'<br>';
			if ($eliminar_cat[$c['Lineasminumet']['id']] == 0){
				echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Lineasminumet']['id']),
					array('class'=>'boton_accion'),
					'Estás seguro que deseas eliminar?').'<br>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>
