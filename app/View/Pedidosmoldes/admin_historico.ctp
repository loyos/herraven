<div class="wrap">
<?php echo $this->Html->link("Regresar",array('action' => 'admin_index'),array('class' => 'boton'));?>
<h2>Histórico de Producción 1 </h2>

<?php if (!empty($pedidos)) { ?>
	<table width= '100%' class="tabla_index_sin_width">
		<tr>
			<th>Fecha</th>
			<th>Usuario</th>
			<th>Ubicación</th>
			<th>Molde</th>
			<th>Cantidad</th>
			<th>#Pedido</th>
			<th>Estatus</th>
		</tr>
		<?php foreach ($pedidos as $p) { ?>
			<tr>
				<td><?php 
				$date = date_create( $p['Pedidosmolde']['fecha']);
				echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo $users[$p['Pedidosmolde']['id']] ?></td>
				<td><?php echo $p['Molde']['ubicacion'] ?></td>
				<td><?php echo $p['Molde']['codigo'] ?></td>
				<td><?php echo $p['Pedidosmolde']['cantidad'] ?></td>
				<td><?php echo $p['Pedidosmolde']['numero'] ?></td>
				<td style="padding-top:13px"><?php echo $this->Html->link($p['Pedidosmolde']['status'],array(''),array('class' => 'boton boton_rojo'));?>
				<td>
			</tr>
		<?php } ?>
	</table>
<?php } else {
	echo '<h3>No hay pedidos finalizados</h3>';
}?>
</div>
