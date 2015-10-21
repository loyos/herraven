<div class="wrap">
<div class = "derecha">
	<?php
	echo $this->Html->link("Nueva Orden",array('controller' => 'moldes','action' => 'admin_catalogo'),array('class' => 'boton'));
	echo '<br><br>';
	echo $this->Html->link("Histórico",array('action' => 'admin_historico'),array('class' => 'boton'));
	?>
</div>
<?php //$this->element('search_egresos'); ?>

<h2>Producción 1 </h2>

<div class = "pedidos_pendientes">
	Nuevas ordenes de producción: <b> <?php echo $count_nuevos; ?> </b>
	<br>
	Ordenes en producción: <b> <?php echo $count_produccion; ?> </b>
</div>

<?php if (!empty($pedidos)) { ?>
	<table width= '100%' class="tabla_index_sin_width">
		<tr>
			<th>Fecha</th>
			<th>Usuario</th>
			<th>Ubicación</th>
			<th>Molde</th>
			<th>Cantidad</th>
			<th>#Pedido</th>
			<th style="max-width:120px">Comentario</th>
			<th>Estatus</th>
		</tr>
		<?php foreach ($pedidos as $p) { ?>
			<tr>
				<td><?php 
				$date = date_create( $p['Pedidosmolde']['fecha']);
				echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo $p['User']['username'] ?></td>
				<td><?php echo $p['Molde']['ubicacion'] ?></td>
				<td><?php echo $p['Molde']['codigo'] ?></td>
				<td><?php echo $p['Pedidosmolde']['cantidad'] ?></td>
				<td><?php echo $p['Pedidosmolde']['numero'] ?></td>
				<td style="max-width:120px"><?php echo $p['Pedidosmolde']['comentario'] ?></td>
				<?php 
				if ($p['Pedidosmolde']['status'] == 'Nueva Orden') {
					$parametro = 'En Producción';
					$class = 'boton_blanco';
				} else {
					$parametro = 'Finalizado';
					$class = 'boton_verde';
				}
				if ($parametro == 'En Producción' && !in_array($p['Pedidosmolde']['id'], $disponible)) { ?>
					<td style="padding-top:13px; color:red">No disponible<td>
				<?php
				} else {
				?>
				<td style="padding-top:13px"><?php echo $this->Html->link($p['Pedidosmolde']['status'],array('action' => 'cambiar_status',$p['Pedidosmolde']['id'],$parametro ),array('class' => 'boton '.$class));?>
				<td>
				<?php } ?>
				
			</tr>
		<?php } ?>
	</table>
<?php } else {
	echo '<h3>No hay pedidos registrados</h3>';
}?>
</div>
