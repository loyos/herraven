<div class="wrap">
<?php echo $this->Html->link("Regresar",array('action' => 'admin_index'),array('class' => 'boton'));?>
<h2>Histórico de Producción 2 </h2>

<?php if (!empty($pedidos)) { ?>
	<table width= '100%' class="tabla_index_sin_width">
		<tr>
			<th>#Pedido</th>
			<th>Fecha</th>
			<th>Usuario</th>
			<th>Artículo</th>
			<th>Cantidad</th>
			<th>Estatus</th>
		</tr>
		<?php foreach ($pedidos as $p) { ?>
			<tr>
				<td><?php echo $p['Pedidosproduccion']['numero'] ?></td>
				<td><?php 
				$date = date_create( $p['Pedidosproduccion']['fecha']);
				echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo $users[$p['Pedidosproduccion']['id']] ?></td>
				<td><?php echo $p['Articulosproduccion']['codigo'] ?></td>
				<td><?php echo $p['Pedidosproduccion']['cantidad'] ?></td>
				<td style="padding-top:13px"><?php echo $this->Html->link($p['Pedidosproduccion']['status'],array(''),array('class' => 'boton boton_rojo'));?>
				<td>
			</tr>
		<?php } ?>
	</table>
<?php } else {
	echo '<h3>No hay pedidos finalizados</h3>';
}?>
</div>
