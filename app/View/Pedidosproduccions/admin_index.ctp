<div class="wrap">
<div class = "derecha">
	<?php
	echo $this->Html->link("Nueva Orden",array('controller' => 'articulosproduccions','action' => 'admin_catalogo'),array('class' => 'boton'));
	echo '<br><br>';
	echo $this->Html->link("Histórico",array('action' => 'admin_historico'),array('class' => 'boton'));
	?>
</div>
<?php //$this->element('search_egresos'); ?>

<h2>Producción 2 </h2>

<div class = "pedidos_pendientes">
	Nuevas ordenes de producción: <b> <?php echo $count_nuevos; ?> </b>
	<br>
	Ordenes en producción: <b> <?php echo $count_produccion; ?> </b>
</div>

<?php if (!empty($pedidos)) { ?>
	<table width= '100%' class="tabla_index_sin_width">
		<tr>
			<th>#Pedido</th>
			<th>Fecha</th>
			<th>Usuario</th>
			<th>Articulo</th>
			<th>Cantidad(pzas)</th>
			<th>Materia Prima</th>
			<th>Cantidad de MP</th>
			<th>Estatus</th>
		</tr>
		<?php foreach ($pedidos as $p) { ?>
			<tr>
				<td><?php echo $p['Pedidosproduccion']['numero'] ?></td>
				<td><?php 
				$date = date_create( $p['Pedidosproduccion']['fecha']);
				echo date_format($date, 'd-m-Y') ?></td>
				<td><?php echo $p['User']['username'] ?></td>
				<td><?php echo $p['Articulosproduccion']['codigo'] ?></td>
				<td><?php echo number_format($p['Pedidosproduccion']['cantidad'],0,',','.') ?></td>
				<td><?php echo $p['Articulosproduccion']['Materiasprimasproduccion']['descripcion'] ?></td>
				<td><?php echo number_format($p['Articulosproduccion']['cantidad']*$p['Pedidosproduccion']['cantidad'],0,',','.').' '.$p['Articulosproduccion']['Materiasprimasproduccion']['unidad'] ?></td>
				<?php 
				if ($p['Pedidosproduccion']['status'] == 'Nueva Orden') {
					$parametro = 'En Producción';
					$class = 'boton_blanco';
				} else {
					$parametro = 'Finalizado';
					$class = 'boton_verde';
				}
				if ($parametro == 'En Producción' && !in_array($p['Pedidosproduccion']['id'], $disponible)) { ?>
					<td style="padding-top:13px; color:red">No disponible<td>
				<?php
				} else {
				?>
				<td style="padding-top:13px; width:120px;"><?php echo $this->Html->link($p['Pedidosproduccion']['status'],array('action' => 'cambiar_status',$p['Pedidosproduccion']['id'],$parametro ),array('class' => 'boton '.$class));?>
				<td>
				<?php } ?>
			</tr>
		<?php } ?>
	</table>
<?php } else {
	echo '<h3>No hay pedidos registrados</h3>';
}?>
</div>
