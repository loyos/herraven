<div class="wrap">
	<?php
	echo $this->Html->link('Regresar',array('action' => 'admin_movimientos',$lote_id, $nombre));
	?>
	<div class = "search">
		<table>
			<tr>
				<th  style="border-bottom:1px solid black">Insumo</th>
				<th style="border-bottom:1px solid black">Trimestre</th>
				<th style="border-bottom:1px solid black">Año</th>
			</tr>
			<tr>
				<td><?php echo $nombre ?></td>
				<td><?php echo $trimestre ?></td>
				<td><?php echo $ano ?></td>
			</tr>
		</table>
	</div>
	<h2>Movimientos trimestrales</h2>
	<?php
	echo $this->element('admin_consultar_movimientos_insumos');
	?>
</div>