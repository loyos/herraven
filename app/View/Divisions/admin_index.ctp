<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Divisiones</h1>
<?php 
	if (!empty($divisiones)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>División</th>
		<th>Nombre</th>
		<th>Gerente Divisional</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($divisiones as $u) {
			echo '<tr>';
			echo '<td>'.$u['Division']['numero'].'</td>';
			echo '<td>'.$u['Division']['nombre'].'</td>';
			echo '<td>'.$u['User']['nombre'].' '.$u['User']['apellido'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$u['Division']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$u['Division']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'<br>'.
				$this->Html->link('Ver',array('action' => 'admin_ver',$u['Division']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay divisiones registradas </h3>';
	}
?>
</div>
