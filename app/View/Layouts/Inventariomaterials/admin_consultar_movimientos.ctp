<div class="wrap">
	<?php
	echo $this->Html->link('Regresar',array('action' => 'admin_movimientos',$materiaprima));
	?>
	<div class = "search">
		<table>
			<tr>
				<th  style="border-bottom:1px solid black">Materia prima</th>
				<th style="border-bottom:1px solid black">Trimestre</th>
				<th style="border-bottom:1px solid black">Año</th>
				<th style="border-bottom:1px solid black">Unidad</th>
			</tr>
			<tr>
				<td><?php echo $materiaprima ?></td>
				<td><?php echo $trimestre ?></td>
				<td><?php echo $ano ?></td>
				<td><?php echo $entradas[0]['Materiasprima']['unidad'] ?></td>
			</tr>
		</table>
	</div>
	<h2>Movimientos trimestrales</h2>
	<?php
	echo $this->element('admin_consultar_movimientos');
	?>
</div>