<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Departamentos</h1>
<?php 
	if (!empty($departamentos)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Departamento</th>
		<th>Nombre</th>
		<th>Jefe departamental</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($departamentos as $u) {
			echo '<tr>';
			echo '<td>'.$u['Departamento']['numero'].'</td>';
			echo '<td>'.$u['Departamento']['nombre'].'</td>';
			if (empty($u['User']['nombre']) && empty($u['User']['apellido'])) {
				$val = 'Sin jefe departamental asignado';
			} else {
				$val = $u['User']['nombre'].' '.$u['User']['apellido'];
			}
			echo '<td>'.$val.'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$u['Departamento']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$u['Departamento']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'<br>'.
				$this->Html->link('Ver',array('action' => 'admin_ver',$u['Departamento']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay departamentos registradas </h3>';
	}
?>
</div>
