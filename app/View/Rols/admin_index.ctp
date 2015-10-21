<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Roles</h1>
<?php 
	if (!empty($roles)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Nombre</th>
		<th>Clientes</th>
		<th>Administración</th>
		<th>Producción</th>
		<th>Configuración</th>
		<th></th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($roles as $r) {
			echo '<tr>';
			echo '<td>'.$r['Rol']['nombre'].'</td>';
			//echo $this->Form->create('Rol',array('action' => 'admin_permisologia','onSubmit' => 'prueba('.$r['Rol']['id'].')'));
			echo $this->Form->create('Rol',array('action' => 'admin_permisologia'));
			echo '<td>';
			if (!empty($bloques[$r['Rol']['id']]) && in_array('1',$bloques[$r['Rol']['id']])) {
				$checked = true;
			} else {
				$checked = false;
			}
			echo $this->Form->input('bloque_cliente',array(
			'type' => 'checkbox',
			'label' => false,
			'checked' => $checked,
			//'name' => 'cliente['.$r['Rol']['id'].']',
			));
			echo '</td>';
			echo '<td>';
			if (!empty($bloques[$r['Rol']['id']]) && in_array('2',$bloques[$r['Rol']['id']])) {
				$checked = true;
			} else {
				$checked = false;
			}
			echo $this->Form->input('bloque_administrador',array(
			'type' => 'checkbox',
			'label' => false,
			'checked' => $checked,
			//'name' => 'administrador['.$r['Rol']['id'].']',
			));
			echo '</td>';
			echo '<td>';
			if (!empty($bloques[$r['Rol']['id']]) && in_array('3',$bloques[$r['Rol']['id']])) {
				$checked = true;
			} else {
				$checked = false;
			}
			echo $this->Form->input('bloque_produccion',array(
			'type' => 'checkbox',
			'label' => false,
			'checked' => $checked,
			//'name' => 'produccion['.$r['Rol']['id'].']',
			));
			echo '</td>';
			echo '<td>';
			if (!empty($bloques[$r['Rol']['id']]) && in_array('4',$bloques[$r['Rol']['id']])) {
				$checked = true;
			} else {
				$checked = false;
			}
			echo $this->Form->input('bloque_configuracion',array(
			'type' => 'checkbox',
			'label' => false,
			'checked' => $checked,
			//'name' => 'configuracion['.$r['Rol']['id'].']',
			));
			echo '</td>';
			echo '<td>';
			echo $this->Form->input('rol',array(
				'type' => 'hidden',
				'label' => false,
				'id' => 'rol'.$r['Rol']['id'],
				'value' => $r['Rol']['id']
			));
			echo $this->Form->submit('Permisología', array('class' => 'button'));
			echo $this->Form->end();
			echo '</td>';
			echo '<td>';
			echo $this->Html->link('Editar',array('action' => 'admin_editar',$r['Rol']['id']),array('class'=>'boton_accion')).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay roles registrados</h3>';
	}
?>
</div>
<script>
// function prueba($id){
	// alert($id);
	// //$('#rol'.<?php $r['Rol']['id'] ?>).val($id);
// }
</script>