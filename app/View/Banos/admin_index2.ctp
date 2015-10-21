<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Baños</h1>
<?php 
	if (!empty($banos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Linea</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($banos as $c) {
			echo '<tr>';
			echo '<td>'.$c['Bano']['nombre'].'</td>';
			echo '<td>'.$c['Bano']['descripcion'].'</td>';
			echo '<td>'.$c['Lineasgalvanica']['nombre'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array('action' => 'admin_editar',$c['Bano']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$c['Bano']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?');
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay baños registrados</h3>';
	}
?>
</div>
