<div class="wrap">
<?php
echo $this->Html->link('Agregar',array('action' => 'admin_editar'),array('class'=>'boton'));
?>
<h1>Suministros</h1>
<?php 
	if (!empty($proveedores)) {
		?>
		<table class="tabla_index">
		<tr>
		<th>Denom. Legal</th>
		<th>Representante</th>
		<th>Telefono</th>
		<th>Email representante</th>
		<th>Provee</th>
		<th>Acciones</th>
		</tr>
		<?php
		foreach($proveedores as $u) {
			echo '<tr>';
			echo '<td>'.$u['Proveedor']['denominacion_legal'].'</td>';
			echo '<td>'.$u['Proveedor']['representante'].'</td>';
			echo '<td>'.$u['Proveedor']['telefono'].'</td>';
			echo '<td>'.$u['Proveedor']['email_representante'].'</td>';
			if ($u['Proveedor']['tipo'] == 'herramientas') {
				$tipo = 'Herramientas';
			}
			if ($u['Proveedor']['tipo'] == 'insumos') {
				$tipo = 'Insumos';
			}
			if ($u['Proveedor']['tipo'] == 'materiasprimas') {
				$tipo = 'Materias Primas';
			}
			echo '<td><u>'.$tipo.':</u><br>';
			if (!empty($u['Lotesherramienta'][0])) {
				echo $u['Lotesherramienta'][0]['nombre'];
			}
			if (!empty($u['Lote'][0])) {
				echo $u['Lote'][0]['nombre'];
			}
			if (!empty($u['Materiasprima'])) {
				foreach ($u['Materiasprima'] as $m) {
					echo $m['descripcion'].'<br>';
				}
			}
			echo '</td>';
			echo '<td style = "line-height: 21px;">'.$this->Html->link('Editar',array(
				'action' => 'admin_editar',$u['Proveedor']['id']),array('class'=>'boton_accion')).' '.$this->Html->link('Eliminar',array('action' => 'admin_eliminar',$u['Proveedor']['id']),array('class'=>'boton_accion'),'¿Estás seguro que deseas eliminar?').'</td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<h3>No hay proveedores registrados </h3>';
	}
?>
</div>
