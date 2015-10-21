<div class="wrap">
	<?php echo $this->Html->link('Regresar',array('action' =>'admin_index',$lote_id),array('class'=>'boton'));?>
	<h1>Lista de Proveedores para "<?php echo $lote ?>"</h2>
	<?php 
	if (!empty($proveedores)) { ?>
		<table class="tabla_index">
			<tr>
				<th>Denominación legal</th>
				<th>Representante</th>
				<th>Email Representante</th>
				<th>Teléfono</th>
			</tr>
			<?php foreach($proveedores as $p) { ?>
				<tr>
					<td><?php echo $p['Proveedor']['denominacion_legal'] ?></td>
					<td><?php echo $p['Proveedor']['representante'] ?></td>
					<td><?php echo $p['Proveedor']['email_representante'] ?></td>
					<td><?php echo $p['Proveedor']['telefono'] ?></td>
				</tr>
			<?php } ?>
			<tr>
				
			</tr>
		</table>
	<?php
	} else {
		echo '<h3>Este lote no tiene proveedores</h3>';
	}
	?>
</div>