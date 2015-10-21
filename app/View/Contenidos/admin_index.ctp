<div class="wrap">
	<?php
	echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
	echo '<h1>Web</h1>';
	if (!empty($contenidos)) {
		echo '<table class="tabla_index">';
		echo '<tr>';
			echo '<th>Pestaña</th>';
			echo '<th>Título</th>';
			//echo '<th>Contenido</th>';
			echo '<th>Video</th>';
			echo '<th>Acciones</th>';
		echo '</tr>';
		foreach ($contenidos as $cont) {
			echo '<tr>';
				echo '<td>'.$cont['Contenido']['alias'].'</td>';
				echo '<td>'.$cont['Contenido']['titulo'].'</td>';
				// $val = substr($cont['Contenido']['contenido'],0,30);
				// $sin_p = str_replace("<p>",' ',$val);
				// $sin_p = str_replace("</p>",' ',$sin_p);
				//echo '<td>'.$sin_p.'...</td>';
				echo '<td>'.$cont['Contenido']['video'].'</td>';
				echo '<td>';
				echo $this->Html->link('Editar',array('action' => 'admin_editar',$cont['Contenido']['id']),array('class' => 'boton_accion'));
				echo '<br>';
				echo $this->Html->link('Agregar imagen',array('action' => 'admin_agregar_imagen_contenido',$cont['Contenido']['id']),array('class' => 'boton_accion'));
				echo '<br>';
				echo $this->Html->link('Eliminar',array(
					'action' => 'admin_eliminar',$cont['Contenido']['id']
				),
				array(
					'class' => 'boton_accion'
				),
				'¿Estás seguro que deseas eliminar esta pestaña? Se eliminará todo el contenido');
				echo '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}	else {
		echo '<h3>No hay pestañas de contenido</h3>';
	}
	?>
</div>