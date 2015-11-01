<div class="wrap">
<div class="agregar_inventario">
	<?php
	echo $this->Html->link('Ingreso de materia prima',array('action' => 'admin_editar'),array('class'=>'boton'));
	echo ' ';
	echo $this->Html->link('Agregar nueva materia prima',array('controller' => 'materiasprimas','action' => 'admin_editar'),array('class'=>'boton'));
	echo ' ';
	echo $this->Html->link('Movimientos',array('controller' => 'inventariomaterials','action' => 'admin_movimientos'),array('class'=>'boton'));
	echo '<br>';

	?>
</div>
<div class="ano_inventario">
	<table>
	<tr>
	<td>
	<?php echo $this->Html->link('Ver reporte',array('action' => 'admin_reporte','ext' => 'pdf'),array('target'=>'_blank','class'=>'boton')); ?>
	</td>
	<td>
	<b><u>Año</u></b></td>
	</tr>
	<tr><td></td>
	<td>
	<?php echo $ano; ?>
	</td>
	</tr></table>
</div>
<br>
<h1>Inventario Materias prima</h1>
<?php 
	if (!empty($materiasprima)) {
		echo $this->element('admin_inventario');
	}
?>
</div>
