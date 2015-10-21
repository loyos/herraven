<div class="wrap">
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
			echo '<td>'.$this->Html->link('Seleccionar',array('action' => 'admin_seleccionar',$c['Bano']['id']),array('class'=>'boton_accion','target' => '_blank'));
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay baños registrados</h3>';
	}
?>
</div>
