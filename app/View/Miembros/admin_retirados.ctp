<div class="wrap">
<h1>Miembros Retirados del Personal</h1>
<?php 
	if (!empty($miembros)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Nombre y Apellido</th>
		<th>Puesto</th>
		<th>Email</th>
		<th>Telefono</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($miembros as $u) {
			echo '<tr>';
			echo '<td>'.$u['User']['nombre'].' '.$u['User']['apellido'].'</td>';
			echo '<td>'.$u['Miembro']['puesto'].'</td>';
			echo '<td>'.$u['User']['email'].'</td>';
			echo '<td>'.$u['Miembro']['telefono'].'</td>';
			echo '<td>'.$this->Html->link('Ver',array('action' => 'admin_ver',$u['Miembro']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay personal registrado </h3>';
	}
?>
</div>
