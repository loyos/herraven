<div class="wrap">

<?php echo $this->element('search_pedidos'); ?>

<h2>Pedidos</h2>
<div class = "pedidos_pendientes">
	Pedidos Pendientes de todos los clientes: <b> <?php echo count($pedidos_pendientes); ?> </b>
</div>

<?php if (!empty($pedidos)) { ?>
	<table width= '100%'  class="tabla_index">
		<tr>
			<th>Acciones</th>
			<th>Fecha</th>
			<th>Nº de Pedido</th>
			<th>Cliente</th>
			<th>Articulo</th>
			<th>Acabado</th>
			<th>Cajas</th>
			<th>Cantidad</th>
			<th>Estatus</th>
		</tr>
		<?php foreach ($pedidos as $p) { ?>
			<tr>
				<td>
				<?php 
				if ($status[$p['Pedido']['id']] != 'Despachado') {
					if ($status[$p['Pedido']['id']] != 'Cancelado') {
						echo $this->Html->link('Cancelar',array('action' => 'admin_cancelar',$p['Pedido']['id'],'admin_pedidos'), array('class' => 'boton_accion'), "¿Estas seguro que deseas cancelar el pedido?");
					}
					echo $this->Html->link('Eliminar',array('action' => 'admin_eliminar',$p['Pedido']['id'],'admin_pedidos'), array('class' => 'boton_accion'), "¿Estas seguro que deseas eliminar el pedido?");
				}
				if ($status[$p['Pedido']['id']] == 'Preparado') {
					echo '<br>'.$this->Html->link('Ejecutar',array('action' => 'admin_ejecutar_despacho',$p['Pedido']['id']), array('class' => 'boton_accion'));
				} 
				if ($status[$p['Pedido']['id']] == 'Progreso-Despacho') {
					echo '<br>';
					echo $this->Html->link('Ejecutar despacho',array('action' => 'admin_pedido_terminado',$p['Pedido']['id']), array('class' => 'boton_accion'));
				}
				?></td>
				<td><?php $fecha = explode(' ',$p['Pedido']['fecha']);
				$date = date_create($fecha[0]);
				echo date_format($date, 'd-m-Y'); ?></td>
				
				<td><?php echo $p['Pedido']['num_pedido'] ?></td>
				<td><?php echo $p['Cliente']['denominacion_legal'] ?></td>
				<td><?php echo $p['Articulo']['codigo'] ?></td>
				<?php 
					if (empty($p['Acabado']['acabado'])) {
						$p['Acabado']['acabado'] = 'Sin Acabado';
					}
				?>
				<td><?php echo $p['Acabado']['acabado'] ?></td>
				<td><?php echo $p['Pedido']['cantidad_cajas'] ?></td>
				<td><?php echo $p['Pedido']['cantidad_cajas'] * $p['Articulo']['cantidad_por_caja'] ?></td>
				<td><?php echo $status[$p['Pedido']['id']] ?></td>
			</tr>
		<?php } ?>
	</table>
<?php } else {
	echo '<h2>No hay pedidos registrados</h2>';
	}?>
</div>
