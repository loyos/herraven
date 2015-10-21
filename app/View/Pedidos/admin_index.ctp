<div class="wrap">

<?php echo $this->element('search_egresos'); ?>

<h2>Egreso de Almacén</h2>

<div class = "pedidos_pendientes">
	Egresos Pendientes de todos los clientes: <b> <?php echo count($pedidos_pendientes); ?> </b>
</div>

<?php if (!empty($pedidos)) { ?>
	<table width= '100%' class="tabla_index">
		<tr>
			<th></th>
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
				<td><?php if ($status[$p['Pedido']['id']] == 'Disponible') {
					echo $this->Html->link('Ejecutar',array('action' => 'admin_ejecutar_pedido',$p['Pedido']['id']), array('class' => 'boton_accion'));
				} ?></td>
				<td><?php 
				$date = date_create( $p['Pedido']['fecha']);
				echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo $p['Pedido']['num_pedido'] ?></td>
				<td><?php echo $p['Cliente']['denominacion_legal'] ?></td>
				<td><?php echo $p['Articulo']['codigo'] ?></td>
				<?php if (!empty($p['Acabado']['acabado'])) { 
					$a =$p['Acabado']['acabado'];
					} else {
						$a = 'Sin acabado';
					}
				?>
				<td><?php echo $a ?></td>
				<td><?php echo $p['Pedido']['cantidad_cajas'] ?></td>
				<td><?php echo $p['Pedido']['cantidad_cajas'] * $p['Articulo']['cantidad_por_caja'] ?></td>
				<td><?php echo $status[$p['Pedido']['id']] ?></td>
			</tr>
		<?php } ?>
	</table>
<?php } else {
	echo '<h3>No hay pedidos registrados</h3>';
}?>
</div>
