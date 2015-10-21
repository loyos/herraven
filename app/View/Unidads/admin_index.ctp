<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Unidades</h1>
<?php 
	if (!empty($unidades)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Unidad</th>
		<th>Nombre</th>
		<th>Jefe de la unidad</th>
		<th>Depto.</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($unidades as $u) {
			echo '<tr>';
			echo '<td>'.$u['Unidad']['numero'].'</td>';
			echo '<td>'.$u['Unidad']['nombre'].'</td>';
			echo '<td>'.$u['User']['nombre'].' '.$u['User']['apellido'].'</td>';
			if ($u['Unidad']['departamento_id'] != 1) {
				$val = $u['Departamento']['nombre'];
			} else {
				$val = 'Departamento no asignado';
			}
			echo '<td>'.$val.'</td>';
			echo '<td>'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$u['Unidad']['id']),array('class'=>'boton_accion')).'<br>'.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$u['Unidad']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'<br>'.
				$this->Html->link('Ver',array('action' => 'admin_ver',$u['Unidad']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay unidades registradas </h3>';
	}
?>
</div>
