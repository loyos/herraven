<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Materias Prima Galvánicas </h1>
<?php 
	if (!empty($materias)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Materia prima</th>
		<th>Unidad</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($materias as $m) {
			echo '<tr>';
			echo '<td>'.$m['Materiasprimasgalvanica']['descripcion'].'</td>';
			echo '<td>'.$m['Materiasprimasgalvanica']['unidad'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$m['Materiasprimasgalvanica']['id']),array('class'=>'boton_accion')).'<br>';
			//if($borrar[$m['Materiasprimasproduccion']['id']]==1){
				echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$m['Materiasprimasgalvanica']['id'])
					,array('class'=>'boton_accion'),
					'¿Estás seguro que deseas eliminar?');
			//}
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No existen materias primas</h3>';
	}
?>
</div>
