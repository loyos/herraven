<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Lineas Galvánicas </h1>
<?php 
	if (!empty($lineas)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Nombre</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($lineas as $m) {
			echo '<tr>';
			echo '<td>'.$m['Lineasgalvanica']['nombre'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$m['Lineasgalvanica']['id']),array('class'=>'boton_accion')).'<br>';
			//if($borrar[$m['Materiasprimasproduccion']['id']]==1){
				echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$m['Lineasgalvanica']['id'])
					,array('class'=>'boton_accion'),
					'¿Estás seguro que deseas eliminar?');
			//}
			echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No existen Lineas</h3>';
	}
?>
</div>
