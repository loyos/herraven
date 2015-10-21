<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Usuarios</h1>
<?php 
	if (!empty($usuarios)){
		?>
		<table class="tabla_index">
		<tr>
		<th>Username</th>
		<th>Nombre y Apellido</th>
		<th>Email</th>
		<th>Rol</th>
		<th>Cliente</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($usuarios as $u) {
			echo '<tr>';
			echo '<td>'.$u['User']['username'].'</td>';
			echo '<td>'.$u['User']['nombre'].' '.$u['User']['apellido'].'</td>';
			echo '<td>'.$u['User']['email'].'</td>';
			echo '<td>'.$u['Rol']['nombre'].'</td>';
			echo '<td>'.$u['Cliente']['denominacion_legal'].'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$u['User']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$u['User']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'<br>'.
				$this->Html->link('Ver',array('action' => 'admin_ver',$u['User']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</div>
