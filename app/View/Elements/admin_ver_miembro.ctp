<h1>Miembro del Personal</h1>
<?php 
	echo '<table  class="tabla_ver">';
	echo '<tr>';
	echo '<th>Foto</th>';
	echo '<td>';
	echo $this->Html->image('users/'.$miembro['User']['imagen'],array('width' => '100px'));
	echo '</td>';
	echo '</tr>';
	if ($miembro['User']['usuario'] == 1){
		echo '<tr>';
		echo '<th>Username</th>';
		echo '<td>';
		echo $miembro['User']['username'];
		echo '</td>';
		echo '</tr>';
	}
	echo '<tr>';
	echo '<th>Nombre y apellido</th>';
	echo '<td>';
	echo $miembro['User']['nombre'].' '.$miembro['User']['apellido'];	
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Estatus</th>';
	echo '<td>';
	echo $miembro['Miembro']['status'];	
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Email</th>';
	echo '<td>';
	echo $miembro['User']['email'];;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Fecha de nacimiento</th>';
	echo '<td>';
	$date = new DateTime($miembro['Miembro']['fecha_nacimiento']);
	echo $date->format('d-m-Y');
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Edad</th>';
	echo '<td>';
	echo $edad;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Telefono</th>';
	echo '<td>';
	echo $miembro['Miembro']['telefono'];
	if (!empty($miembro['Miembro']['celular'])) {
		echo ' / '.$miembro['Miembro']['celular'];
	}
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Dirección</th>';
	echo '<td>';
	echo $miembro['Miembro']['direccion'];
	echo '</td>';
	echo '</tr>';
	if (!empty($miembro['Miembro']['contacto1'])) {
		echo '<tr>';
		echo '<th>Contacto</th>';
		echo '<td>';
		echo 'Nombre: '.$miembro['Miembro']['contacto1'];
		if (!empty($miembro['Miembro']['parentesco1'])){
			echo '<br>Parentesco: '.$miembro['Miembro']['parentesco1'];
		}
		if (!empty($miembro['Miembro']['tlf1_contacto1'])){
			echo '<br>Telefono: '.$miembro['Miembro']['tlf1_contacto1'];
		}
		if (!empty($miembro['Miembro']['tlf1_contacto1']) && !empty($miembro['Miembro']['tlf2_contacto1'])){
			echo '/';
		}
		if (!empty($miembro['Miembro']['tlf2_contacto1'])){
			echo $miembro['Miembro']['tlf2_contacto1'];
		}
		echo '</td>';
		echo '</tr>';
	}
	if (!empty($miembro['Miembro']['contacto2'])) {
		echo '<tr>';
		echo '<th>Contacto</th>';
		echo '<td>';
		echo 'Nombre: '.$miembro['Miembro']['contacto2'];
		if (!empty($miembro['Miembro']['parentesco2'])){
			echo '<br>Parentesco: '.$miembro['Miembro']['parentesco2'];
		}
		if (!empty($miembro['Miembro']['tlf1_contacto2'])){
			echo '<br>Telefono: '.$miembro['Miembro']['tlf1_contacto2'];
		}
		if (!empty($miembro['Miembro']['tlf1_contacto2']) && !empty($miembro['Miembro']['tlf2_contacto2'])){
			echo '/';
		}
		if (!empty($miembro['Miembro']['tlf2_contacto2'])){
			echo $miembro['Miembro']['tlf2_contacto2'];
		}
		echo '</td>';
		echo '</tr>';
	}
	if (!empty($miembro['Miembro']['contacto3'])) {
		echo '<tr>';
		echo '<th>Contacto</th>';
		echo '<td>';
		echo 'Nombre: '.$miembro['Miembro']['contacto3'];
		if (!empty($miembro['Miembro']['parentesco3'])){
			echo '<br>Parentesco: '.$miembro['Miembro']['parentesco3'];
		}
		if (!empty($miembro['Miembro']['tlf1_contacto3'])){
			echo '<br>Telefono: '.$miembro['Miembro']['tlf1_contacto3'];
		}
		if (!empty($miembro['Miembro']['tlf1_contacto3']) && !empty($miembro['Miembro']['tlf2_contacto3'])){
			echo '/';
		}
		if (!empty($miembro['Miembro']['tlf2_contacto3'])){
			echo $miembro['Miembro']['tlf2_contacto3'];
		}
		echo '</td>';
		echo '</tr>';
	}
	echo '<tr>';
	echo '<th>Fecha de ingreso</th>';
	echo '<td>';
	$date = new DateTime($miembro['Miembro']['fecha_ingreso']);
	echo $date->format('d-m-Y');
	echo '</td>';
	echo '</tr>';
	if ($miembro['Miembro']['status'] == 'Retirado') {
		echo '<tr>';
		echo '<th>Fecha de retiro</th>';
		echo '<td>';
		$date = new DateTime($miembro['Miembro']['fecha_retiro']);
		echo $date->format('d-m-Y');
		echo '</td>';
		echo '</tr>';
		echo '<tr>';
		echo '<th>Comentario del retiro</th>';
		echo '<td>';
		echo $miembro['Miembro']['comentario_retiro'];
		echo '</td>';
		echo '</tr>';
		$label = 'Tiempo trabajado';
	} else {
		$label = 'Tiempo de trabajo';
	}
	echo '<tr>';
	echo '<th>'.$label.'</th>';
	echo '<td>';
	echo $tiempo_trabajo;
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Puesto</th>';
	echo '<td>';
	echo $miembro['Miembro']['puesto'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>IQ</th>';
	echo '<td>';
	echo $miembro['Miembro']['IQ'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Fecha del IQ test</th>';
	echo '<td>';
	$date = new DateTime($miembro['Miembro']['fecha_IQ']);
	echo $date->format('d-m-Y');
	echo '</td>';
	echo '</tr>';
	if (!empty($miembro['Miembro']['imagen_test'])){
		echo '<tr>';
		echo '<th>Imagen IQ test</th>';
		echo '<td>';
		echo $this->Html->image('users/test/'.$miembro['Miembro']['imagen_test'],array('width' => '100px'));
		echo '</td>';
		echo '</tr>';
	}
	echo '<tr>';
	echo '<th>Estudios</th>';
	echo '<td>';
	echo $miembro['Miembro']['estudios'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Anotaciones médicas</th>';
	echo '<td>';
	echo $miembro['Miembro']['anotaciones_medicas'];
	echo '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<th>Observaciones</th>';
	echo '<td>';
	echo $miembro['Miembro']['observaciones'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
?>
